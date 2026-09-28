<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Member;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::query();

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $schedules = $query->orderBy('date', 'asc')->get();
        $members = Member::where('status', 'Aktif')->orderBy('name', 'asc')->get();

        return view('pages.schedules.index', compact('schedules', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
            'coach' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dayCodes = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $dayOfWeek = date('w', strtotime($validated['date']));

        $categoryLabel = 'Semua Kategori';
        if ($validated['category'] === 'recurve') $categoryLabel = 'Recurve / Nasional';
        if ($validated['category'] === 'compound') $categoryLabel = 'Compound & Barebow';

        Schedule::create([
            'day_code' => $dayCodes[$dayOfWeek],
            'day_name' => $dayNames[$dayOfWeek],
            'date_num' => date('d', strtotime($validated['date'])),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'category_label' => $categoryLabel,
            'location' => $validated['location'],
            'coach' => $validated['coach'],
            'description' => $validated['description'] ?? null,
            'status' => 'Mendatang',
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal latihan baru berhasil ditambahkan!');
    }

    public function update(Request $request, Schedule $schedule)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'category' => 'required|string',
            'location' => 'required|string',
            'coach' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $dayCodes = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $dayOfWeek = date('w', strtotime($validated['date']));

        $categoryLabel = 'Semua Kategori';
        if ($validated['category'] === 'recurve') $categoryLabel = 'Recurve / Nasional';
        if ($validated['category'] === 'compound') $categoryLabel = 'Compound & Barebow';

        $schedule->update([
            'day_code' => $dayCodes[$dayOfWeek],
            'day_name' => $dayNames[$dayOfWeek],
            'date_num' => date('d', strtotime($validated['date'])),
            'date' => $validated['date'],
            'time' => $validated['time'],
            'title' => $validated['title'],
            'category' => $validated['category'],
            'category_label' => $categoryLabel,
            'location' => $validated['location'],
            'coach' => $validated['coach'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal latihan berhasil diperbarui!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return redirect()->route('schedules.index')->with('success', 'Jadwal latihan berhasil dihapus!');
    }
}
