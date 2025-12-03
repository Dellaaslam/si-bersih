<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    public function index()
    {
        $reports = Reports::with('user')->latest()->get();
        return view('admin.reports', compact('reports'));
    }

    public function confirm(Reports $report)
    {
        $report->update(['status' => 'confirmed']);
        return back()->with('success', 'Laporan dikonfirmasi.');
    }

    public function reject(Reports $report)
    {
        $report->update(['status' => 'rejected']);
        return back()->with('success', 'Laporan ditolak.');
    }
}
