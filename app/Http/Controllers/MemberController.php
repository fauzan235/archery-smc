<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_code', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%")
                  ->orWhere('class', 'like', "%{$search}%");
            });
        }

        if ($request->filled('class')) {
            $query->where('class', 'like', $request->class . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('division')) {
            $query->where('division', $request->division);
        }

        $members = $query->orderBy('member_code', 'asc')->get();

        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'Aktif')->count();
        $inactiveMembers = Member::where('status', '!=', 'Aktif')->count();

        $viewMode = $request->get('view', 'grid');

        return view('pages.members.index', compact('members', 'totalMembers', 'activeMembers', 'inactiveMembers', 'viewMode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'class' => 'required|string|max:50',
            'major' => 'nullable|string|max:100',
            'division' => 'required|string',
            'role' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|string',
        ]);

        $nextNum = Member::count() + 1;
        $memberCode = 'SAC-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        $avatar = "https://api.dicebear.com/7.x/avataaars/svg?seed=" . urlencode($validated['name']);

        Member::create(array_merge($validated, [
            'member_code' => $memberCode,
            'avatar' => $avatar,
            'attendance_rate' => 100,
            'dues_status' => 'Belum Lunas',
            'join_date' => date('Y-m-d'),
        ]));

        return redirect()->route('members.index')->with('success', "Anggota {$validated['name']} ({$memberCode}) berhasil ditambahkan!");
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nisn' => 'nullable|string|max:20',
            'class' => 'required|string|max:50',
            'division' => 'required|string',
            'role' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'status' => 'required|string',
            'dues_status' => 'nullable|string',
        ]);

        $member->update($validated);

        return redirect()->route('members.index')->with('success', "Data anggota {$member->name} berhasil diperbarui!");
    }

    public function destroy(Member $member)
    {
        $name = $member->name;
        $member->delete();

        return redirect()->route('members.index')->with('success', "Anggota {$name} berhasil dihapus dari sistem.");
    }

    public function export(): StreamedResponse
    {
        $members = Member::orderBy('member_code', 'asc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="data_anggota_sac_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($members) {
            $output = fopen('php://output', 'w');
            fputs($output, "\xEF\xBB\xBF"); // UTF-8 BOM for Excel
            fputcsv($output, ['ID Anggota', 'Nama Lengkap', 'NISN', 'Kelas', 'Jurusan', 'Divisi', 'Jabatan', 'No HP/WA', 'Status', 'Iuran', 'Kehadiran (%)', 'Tgl Bergabung']);

            foreach ($members as $m) {
                fputcsv($output, [
                    $m->member_code,
                    $m->name,
                    $m->nisn ?? '-',
                    $m->class,
                    $m->major ?? '-',
                    $m->division,
                    $m->role ?? 'Anggota',
                    $m->phone ?? '-',
                    $m->status,
                    $m->dues_status,
                    $m->attendance_rate . '%',
                    $m->join_date ?? '-'
                ]);
            }
            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
