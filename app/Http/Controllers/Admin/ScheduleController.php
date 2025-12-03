<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        return view('admin.schedule.index', [
            'schedules' => Schedule::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.schedule.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'start'       => 'required|date',
            'end'         => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string'
        ]);

        Schedule::create([
            'title'       => $request->title,
            'start'       => $request->start,
            'end'         => $request->end,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedule.edit', compact('schedule'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'start'       => 'required|date',
            'end'         => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string'
        ]);

        $schedule = Schedule::findOrFail($id);

       $schedule->update([
            'title'       => $request->title,
            'start'       => $request->start,
            'end'         => $request->end,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil dihapus!');
    }

    public function events()
    {
        $events = Schedule::all()->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'start' => $schedule->start,
                'end'   => $schedule->end,
                'url'   => route('admin.schedule.edit', $schedule->id), // ← penting!
            ];
        });

        return response()->json($events);
    }

}
