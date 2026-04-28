<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Expenditure;
use App\Models\MunSection;
use App\Models\MunSectionDetails;
use App\Models\OmranEmployee;
use App\Models\OmranField;
use App\Models\OmranSection;
use App\Models\ToolSection;
use App\Models\ToolSectionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Carbon\Carbon;
use function Laravel\Prompts\select;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenditure::with('category')->get();

        $total = Expenditure::query()->sum('amount');

        $daysSinceMarch17 = (int) Carbon::parse('2025-03-17')->diffInDays(now());


        $totalByCategory = Expenditure::query()->
        select('category_id',
            DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')->get();


        $totalPaid = Expenditure::query()->sum('amount');

        $expenseCount = Expenditure::query()->count();

        $maxCategoryTotal = $totalByCategory->max('total');



        $dailyAverage = $daysSinceMarch17 > 0 ? round($total/$daysSinceMarch17, 2) : 0;


        return view('expenses.index',
            compact('expenses',
                'total',
                'totalByCategory',
                'totalPaid'
                , 'expenseCount',
                'maxCategoryTotal', 'dailyAverage'));


    }


    public function fetchDetails($categoryId)
    {

        if($categoryId == 1){
            $munSectionsDetails = MunSection::query()->withSum('details', 'amount')->get();
            return response()->json([
                'munSecDetails' => $munSectionsDetails,

            ]);
        }
    }

    public function OmranSectionTotals()
    {
        $omranSectionTotals = OmranSection::query()->select('omran_sections.id', 'omran_sections.name')
            ->leftJoin('omran_fields', 'omran_sections.id', '=', 'omran_fields.omran_section_id')
            ->leftJoin('omran_employees', 'omran_fields.id', '=', 'omran_employees.omran_field_id')
            ->leftJoin('expenditures', 'expenditures.id', '=', 'omran_employees.expense_id')
            ->groupBy('omran_sections.id', 'omran_sections.name')
            ->selectRaw('COALESCE(SUM(expenditures.amount), 0) as total_amount')
            ->get();

        return response()->json([
            'omranSectionTotals' => $omranSectionTotals,

        ]);

    }

    public function OmranFieldTotals($sectionId)
    {

        $result = [];
        $fields = OmranField::query()
            ->where('omran_fields.omran_section_id', $sectionId)
            ->select('omran_fields.id', 'omran_fields.name')
            ->get();
        foreach ($fields as $field){
            $distinctEmployee = OmranEmployee::query()->where('omran_field_id', $field->id)->select('employee_id')->distinct()->get();
            $distinctEmployeeCount = $distinctEmployee->count();


            $employeeExpenses = OmranEmployee::query()->where('omran_field_id', $field->id);
            $totalFieldExpenses = Expenditure::query()
                ->whereIn('id', $employeeExpenses->pluck('expense_id'))
                ->sum('amount');

            $singleEmployeeName = null;
            if($distinctEmployeeCount == 1){
                $employeeId = $distinctEmployee->first()->employee_id;
                $singleEmployeeName = Employee::query()->find($employeeId)->name;


            }


            $result[] = [
                'id' => $field->id,
                'name' => $field->name,
                'distinctEmployee' => $distinctEmployee,
                'distinctEmployeeCount' => $distinctEmployeeCount,
                'totalFieldExpenses' => $totalFieldExpenses,
                'singleEmployeeName' => $singleEmployeeName



            ];
        }


        return response()->json([
            'omranFieldTotals' => $result,
        ]);

    }


    public function employeeExpensesDetail($fieldId)
    {

        $TotalEmployeeExpenses = OmranEmployee::query()
            ->leftJoin('expenditures', 'omran_employees.expense_id', '=', 'expenditures.id')
            ->leftJoin('employees', 'employees.id', '=', 'omran_employees.employee_id')
            ->where('omran_employees.omran_field_id', $fieldId)
            ->select('employees.name as employee_name')
            ->selectRaw('sum(expenditures.amount) AS total_amount')
            ->groupBy('employees.name')->get();

        return response()->json([
            'TotalEmployeeExpenses' => $TotalEmployeeExpenses,

        ]);
    }





    public function create()
    {
        return view('expenses.create');
    }


    public function addExpense(Request $request)
    {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|numeric',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $expense = new Expenditure();
        $expense->title = $validated['title'];
        $expense->category_id = $validated['category_id'];
        $expense->amount = $validated['amount'];
        $expense->note = $validated['note'];
        $expense->created_at = $validated['date'];

        if($request->hasFile('image')){
            $path = $request->file('image')->store('expenses', 'public');
            $expense->image = $path;
        }

        $expense->save();


        if($request->category_id == 6){
            $expenseId = $expense->id;
            $omranEmployee = new OmranEmployee();
            $omranEmployee->expense_id = $expenseId;
            //these two should be in validation mode
            $omranEmployee->omran_field_id = $request->field_id;
            $omranEmployee->employee_id = $request->employee_id;

            $omranEmployee->save();
        }

        if($request->category_id == 5){
            $expenseId = $expense->id;
            $addDetail = new ToolSectionDetail();
            $addDetail->expense_id = $expenseId;
            $addDetail->tool_section_id = $request->tool_id;
            $addDetail->save();
        }


        return response()->json([
            'message' => 'successfully saved',

        ]);
    }

    public function getImage($id){
        $expense = Expenditure::query()->findOrFail($id);
        if(!$expense || !$expense->image){
            return response()->json([
                'image_url' => null
            ]);
        }

        $url = asset('storage/'. $expense->image);

        return response()->json([
            'image_url' => $url
        ]);
    }


    public function fetchFields($sectionId)
    {

        $fields = OmranField::query()->where('omran_section_id', $sectionId)->get();
        return response()->json([
            'fields' => $fields,
        ]);
    }

    public function fetchEmployees($fieldId)
    {
        $employees = Employee::query()->where('field_id', $fieldId)->get();
        return response()->json([
            'employees' => $employees,
        ]);
    }

    public function fetchTools()
    {
        $totalSectionAmount = ToolSectionDetail::query()
            ->leftJoin('expenditures', 'tool_section_details.expense_id', '=', 'expenditures.id')
            ->leftJoin('tool_sections', 'tool_section_details.tool_section_id', '=', 'tool_sections.id')
            ->select('tool_sections.name')
            ->selectRaw('COALESCE(SUM(expenditures.amount), 0) as total_amount')
            ->groupBy('tool_section_details.tool_section_id', 'tool_sections.name')
            ->get();

        return response()->json([
            'totalSectionAmount' => $totalSectionAmount,

        ]);


    }
}
