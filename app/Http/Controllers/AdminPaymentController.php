<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminPaymentController extends Controller
{
     public function index()
    {
        $payments = Payment::latest()->get();

        return view('admin.payments.index', compact('payments'));
    }

    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'status' => 'required|in:confirmed,rejected'
        ]);

        $payment->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pembayaran diperbarui!');
    }
}

