<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use Illuminate\Http\Request;

class UserPaymentController extends Controller
{
    // Step 1 - Pilih metode pembayaran
    public function index()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.payments.index', compact('payments'));
    }

    // Step 2 - Simpan metode ke session, lalu redirect ke halaman confirm
    public function confirm(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        // Simpan metode ke session
        session([
            'payment_method' => $request->payment_method
        ]);

        return redirect()->route('user.payments.confirm.show');
    }

    // Step 3 - Tampilkan halaman konfirmasi pembayaran
    public function showConfirm()
    {
        // Ambil metode pembayaran dari session
        $method = session('payment_method');

        if (!$method) {
            return redirect()->route('user.payments.index')
                ->with('error', 'Silakan pilih metode pembayaran terlebih dahulu.');
        }

        // Daftar rekening
        $rekening = [
            'bank_transfer' => '1234567890 - BRI a/n SI-BERSIH',
            'qris' => '08912345678 (QRIS a/n SI-BERSIH)',
            'ewallet' => 'Dana: 08912345678',
        ];

        // Daftar bulan
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
            4 => 'April', 5 => 'Mei', 6 => 'Juni',
            7 => 'Juli', 8 => 'Agustus', 9 => 'September',
            10 => 'Oktober', 11 => 'November', 12 => 'Desember',
        ];

        return view('user.payments.confirm', [
            'method' => $method,
            'account_number' => $rekening[$method] ?? null,
            'months' => $months,
            'year' => date('Y'),
        ]);
    }

    // Step 4 - Upload bukti pembayaran
    public function upload(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'month' => 'required|integer|min:1|max:12',
            'year' => 'required|integer|min:2020|max:2100',
            'proof' => 'required|image|max:2048'
        ]);

        $path = $request->file('proof')->store('payments', 'public');

        Payment::create([
            'user_id' => Auth::id(),
            'method' => $request->payment_method,
            'amount' => 40000, // Nominal iuran
            'month' => $request->month,
            'year' => $request->year,
            'proof' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('user.payments.history')
            ->with('success', 'Pembayaran berhasil dikirim');
    }

    // Riwayat pembayaran
    public function history()
    {
        $payments = Payment::where('user_id', Auth::id())
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('user.payments.history', compact('payments'));
    }
}
