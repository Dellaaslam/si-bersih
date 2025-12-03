<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reports;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua laporan dari semua user
        $laporans = Reports::with('user')->latest()->get();

        $totalLaporan = Reports::count();
        $laporanMenunggu = Reports::where('status', 'pending')->count();
        $laporanSelesai = Reports::where('status', 'confirmed')->count();

        return view('user.dashboard', compact(
            'laporans',
            'totalLaporan',
            'laporanMenunggu',
            'laporanSelesai'
        ));
    }
}
