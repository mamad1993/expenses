<?php

namespace App\Http\Controllers;

use App\Models\PaymentWorker;
use App\Models\Constructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkersController extends Controller
{
    /**
     * Display the workers and constructors dashboard
     */
    public function index()
    {
        $paymentWorkers = PaymentWorker::all();
        $constructors = Constructor::all();

        $allConstructorsPayments = $constructors->sum('amount');
        $allPayment = $paymentWorkers->sum('amount');
        $dueConstructorsPayment = $allConstructorsPayments - $allPayment;
        $simpleWorkers = $constructors->where('type', 'simple')->sum('amount');
        $expertWorkers = $constructors->where('type', 'expert')->sum('amount');
        $totalWorkersEarned =$simpleWorkers + $expertWorkers;


        return view('workers.index', compact('paymentWorkers',
            'constructors',
                        'dueConstructorsPayment',
                        'simpleWorkers',
                        'expertWorkers',
                        'allPayment',
                        'totalWorkersEarned'));
    }

    /**
     * Store a new payment to workers
     */
    public function storePayment(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'date' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
        ], [
            'date.required' => 'تاریخ پرداخت الزامی است',
            'amount.required' => 'مبلغ الزامی است',
            'amount.numeric' => 'مبلغ باید عدد باشد',
            'amount.min' => 'مبلغ نمی‌تواند منفی باشد',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new payment record
        PaymentWorker::create([
            'date' => $request->date,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'پرداخت با موفقیت ثبت شد');
    }

    /**
     * Store a new constructor
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:simple,expert',
        ], [
            'name.required' => 'نام پیمانکار الزامی است',
            'date.required' => 'تاریخ الزامی است',
            'amount.required' => 'مبلغ الزامی است',
            'amount.numeric' => 'مبلغ باید عدد باشد',
            'amount.min' => 'مبلغ نمی‌تواند منفی باشد',
            'type.required' => 'نوع کارگر الزامی است',
            'type.in' => 'نوع کارگر باید ساده یا متخصص باشد',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create new constructor record
        Constructor::create([
            'name' => $request->name,
            'date' => $request->date,
            'amount' => $request->amount,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'پیمانکار با موفقیت ثبت شد');
    }

    /**
     * Delete a payment
     */
    public function destroyPayment($id)
    {
        $payment = PaymentWorker::findOrFail($id);
        $payment->delete();

        return redirect()->back()->with('success', 'پرداخت با موفقیت حذف شد');
    }

    /**
     * Delete a constructor
     */
    public function destroyConstructor($id)
    {
        $constructor = Constructor::findOrFail($id);
        $constructor->delete();

        return redirect()->back()->with('success', 'پیمانکار با موفقیت حذف شد');
    }
}
