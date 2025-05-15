<?php

namespace App\Http\Controllers;

use App\Models\Expenditure;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index()
    {


        $expenses = Expenditure::with('category')->get();

        return view('expenses.index', compact('expenses'));

    }
}
