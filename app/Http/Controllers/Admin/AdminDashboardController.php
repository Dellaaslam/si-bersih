<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\reports;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
     public function index()
    {
        $totalUsers = User::count();
        $totalLaporan = reports::count();
        $laporanMenunggu = reports::where('status', 'pending')->count();
        $laporanSelesai = reports::where('status', 'confirmed')->count();

        // Data laporan per bulan
        $laporanPerBulan = reports::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->groupBy('bulan')
            ->pluck('total','bulan')
            ->all();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalLaporan',
            'laporanMenunggu',
            'laporanSelesai',
            'laporanPerBulan'
        ));
    }
}
