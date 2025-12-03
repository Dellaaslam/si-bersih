<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function events()
    {
        $events = Schedule::all()->map(function ($item) {
            return [
                'id' => $item->id,
                'title' => $item->title,
                'start' => $item->start,
                'end'   => $item->end,
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'start'       => 'required|date',
            'end'         => 'nullable|date|after_or_equal:start',
            'description' => 'nullable|string',
        ]);

        Schedule::create([
            'title'       => $request->title,
            'start'       => $request->start,
            'end'         => $request->end,          // boleh null
            'description' => $request->description,
        ]);

        return redirect()
            ->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil ditambahkan!');
    }

}


