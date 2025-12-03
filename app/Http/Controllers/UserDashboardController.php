<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\reports;

class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua laporan dari semua user
        $laporans = reports::with('user')->latest()->get();

        $totalLaporan = reports::count();
        $laporanMenunggu = reports::where('status', 'pending')->count();
        $laporanSelesai = reports::where('status', 'confirmed')->count();

        return view('user.dashboard', compact(
            'laporans',
            'totalLaporan',
            'laporanMenunggu',
            'laporanSelesai'
        ));
    }
}
