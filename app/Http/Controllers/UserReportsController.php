<?php

namespace App\Http\Controllers;

use App\Models\reports;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserReportsController extends Controller
{
    public function index(Request $request)
{
    $query = reports::where('user_id', Auth::id())->latest();

    // Filter status
    if ($request->status) {
        $query->where('status', $request->status);
    }

    // Search lokasi atau deskripsi
    if ($request->search) {
        $query->where(function($q) use ($request) {
            $q->where('location', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

    $reports = $query->get();

    return view('user.reports.index', compact('reports'));
}


    public function create()
    {
        return view('user.reports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = $request->hasFile('photo') ? $request->photo->store('reports', 'public') : null;

        reports::create([
            'user_id' => Auth::id(),
            'location' => $request->location,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->route('user.reports.index')->with('success', 'Laporan berhasil dikirim!');
    }

    public function edit(reports $report)
    {
        $this->authorizeReport($report);
        return view('user.reports.edit', compact('report'));
    }

    public function update(Request $request, reports $report)
    {
        $this->authorizeReport($report);

        $request->validate([
            'location' => 'required|string',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $report->photo = $request->photo->store('reports', 'public');
        }

        $report->update([
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('user.reports.index')->with('success', 'Laporan berhasil diperbarui!');
    }

    public function destroy(reports $report)
    {
        $this->authorizeReport($report);

        $report->delete();
        return redirect()->route('user.reports.index')->with('success', 'Laporan berhasil dihapus!');
    }

    // Hanya pemilik yang bisa edit/hapus
    private function authorizeReport(reports $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }
    }
}
