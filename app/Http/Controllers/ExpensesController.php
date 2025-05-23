<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
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



        return view('expenses.index', compact('expenses', 'total', 'totalByCategory'));


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
            'hours' => 'nullable|numeric',
            'note' => 'nullable|string',
            'date' => 'required|date'
        ]);

        $expense = new Expenditure();
        $expense->title = $validated['title'];
        $expense->category_id = $validated['category_id'];
        $expense->amount = $validated['amount'];
        $expense->type = $validated['type'];
        $expense->number_of_hours = $validated['hours'];
        $expense->note = $validated['note'];
        $expense->created_at = $validated['date'];

        $expense->save();

        return response()->json([
            'message' => 'successfully saved',

        ]);
    }
}
