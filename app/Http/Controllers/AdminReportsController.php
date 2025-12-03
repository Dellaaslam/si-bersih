<?php

namespace App\Http\Controllers;

use App\Models\reports;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function index()
    {
        $reports = reports::with('user')->latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function confirm(reports $report)
    {
        $report->update(['status' => 'confirmed']);
        return back()->with('success', 'Laporan dikonfirmasi.');
    }

    public function reject(reports $report)
    {
        $report->update(['status' => 'rejected']);
        return back()->with('success', 'Laporan ditolak.');
    }
}
