<?php

use App\Http\Controllers\ExpensesController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExpensesController::class, 'index']);


Route::get('expenses/create', [ExpensesController::class, 'create']);

Route::POST('add_expense', [ExpensesController::class, 'addExpense'])->name('add_expense');
