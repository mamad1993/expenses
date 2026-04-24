<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\WorkersController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ExpensesController::class, 'index']);


Route::get('expenses/create', [ExpensesController::class, 'create']);

Route::POST('add_expense', [ExpensesController::class, 'addExpense'])->name('add_expense');
Route::get('expenses/image/{id}', [ExpensesController::class, 'getImage']);
Route::get('fetchFields/{sectionId}', [ExpensesController::class, 'fetchFields']);
Route::get('fetchEmployees/{fieldId}', [ExpensesController::class, 'fetchEmployees']);

Route::get('/workers', [WorkersController::class, 'index']);
// In web.php
Route::post('/workers/payment/store', [WorkersController::class, 'storePayment'])->name('workers.payment.store');
Route::post('/constructors/store', [WorkersController::class, 'store'])->name('constructors.store');

Route::GET('/expenses/fetchDetails/{categoryId}', [ExpensesController::class, 'fetchDetails']);
Route::GET('/expenses/OmranSectionTotals/{categoryId}', [ExpensesController::class, 'OmranSectionTotals']);
Route::GET('/expenses/OmranFieldTotals/{sectionId}', [ExpensesController::class, 'OmranFieldTotals']);
Route::GET('/expenses/employeeExpensesDetail/{fieldId}', [ExpensesController::class, 'employeeExpensesDetail']);
