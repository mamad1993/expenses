<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenditure::with('category')->get();

        $total = Expenditure::query()->sum('amount');


        $totalByCategory = Expenditure::query()->
        select('category_id',
            DB::raw('SUM(amount) as total'))
            ->groupBy('category_id')->get();




        $totalByRoles = Expenditure::query()
            ->select('role_id', DB::raw('SUM(amount) as roleTotalAmount'))
            ->groupBy('role_id')->get();










        $totalPaid = Expenditure::query()->where('type', 'paid')->sum('amount');

        $totalDues = Expenditure::query()->where('type', 'due')->sum('amount');

        $expenseCount = Expenditure::query()->count();

        $maxCategoryTotal = $totalByCategory->max('total');

        $maxRoleTotal = $totalByRoles->max('roleTotalAmount');



        return view('expenses.index',
            compact('expenses', 'total',
            'totalByCategory', 'totalPaid',
                'totalDues', 'expenseCount',
                'maxCategoryTotal', 'totalByRoles', 'maxRoleTotal'));


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
            'type' => 'required|in:paid,unpaid,due',
            'note' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $expense = new Expenditure();
        $expense->title = $validated['title'];
        $expense->category_id = $validated['category_id'];
        $expense->amount = $validated['amount'];
        $expense->type = $validated['type'];
        $expense->role_id = $request->role_id;
        $expense->note = $validated['note'];
        $expense->created_at = $validated['date'];

        if($request->hasFile('image')){
            $path = $request->file('image')->store('expenses', 'public');
            $expense->image = $path;
        }

        $expense->save();

        return response()->json([
            'message' => 'successfully saved',

        ]);
    }
}
