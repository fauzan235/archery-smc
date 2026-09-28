<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Member;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $selectedDate = $request->get('date', date('Y-m-d'));

        $query = Attendance::with('member')->where('date', $selectedDate);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('member', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_code', 'like', "%{$search}%")
                  ->orWhere('class', 'like', "%{$search}%");
            });
        }

        $attendances = $query->orderBy('created_at', 'desc')->get();

        $activeMembers = Member::where('status', 'Aktif')->orderBy('name', 'asc')->get();
        $totalActive = $activeMembers->count();

        // Calculate stats for selected date
        $allLogsDate = Attendance::where('date', $selectedDate)->get();
        $hadirCount = $allLogsDate->where('status', 'hadir')->count();
        $izinCount = $allLogsDate->where('status', 'izin')->count();
        $sakitCount = $allLogsDate->where('status', 'sakit')->count();
        $recordedCount = $allLogsDate->count();
        $alphaCount = max(0, $totalActive - ($hadirCount + $izinCount + $sakitCount));

        $rate = $totalActive > 0 ? round(($hadirCount / $totalActive) * 100) : 0;

        return view('pages.attendances.index', compact(
            'attendances',
            'activeMembers',
            'selectedDate',
            'totalActive',
            'hadirCount',
            'izinCount',
            'sakitCount',
            'alphaCount',
            'rate'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'status' => 'required|in:hadir,izin,sakit,alpha',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:500',
        ]);

        $time = date('H:i') . ' WIB';

        // Check if attendance already exists for this member on this date
        $existing = Attendance::where('member_id', $validated['member_id'])
            ->where('date', $validated['date'])
            ->first();

        if ($existing) {
            $existing->update([
                'status' => $validated['status'],
                'notes' => $validated['notes'],
                'time' => $time,
            ]);
            $msg = "Status kehadiran anggota berhasil diperbarui!";
        } else {
            Attendance::create([
                'member_id' => $validated['member_id'],
                'date' => $validated['date'],
                'time' => $time,
                'session_name' => 'Latihan Rutin',
                'status' => $validated['status'],
                'notes' => $validated['notes'],
            ]);
            $msg = "Kehadiran berhasil dicatat!";
        }

        // Recalculate member attendance rate
        $memberLogs = Attendance::where('member_id', $validated['member_id'])->get();
        $present = $memberLogs->where('status', 'hadir')->count();
        $newRate = $memberLogs->count() > 0 ? round(($present / $memberLogs->count()) * 100) : 100;
        Member::where('id', $validated['member_id'])->update(['attendance_rate' => $newRate]);

        return redirect()->route('attendances.index', ['date' => $validated['date']])->with('success', $msg);
    }

    public function destroy(Attendance $attendance)
    {
        $date = $attendance->date;
        $attendance->delete();

        return redirect()->route('attendances.index', ['date' => $date])->with('success', 'Catatan absensi berhasil dihapus.');
    }

    public function export(Request $request): StreamedResponse
    {
        $date = $request->get('date', date('Y-m-d'));
        $logs = Attendance::with('member')->where('date', $date)->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="rekap_absensi_' . $date . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($logs, $date) {
            $output = fopen('php://output', 'w');
            fputs($output, "\xEF\xBB\xBF");
            fputcsv($output, ['REKAPITULASI PRESENSI SMECONE ARCHERY CLUB']);
            fputcsv($output, ['Tanggal: ' . $date]);
            fputcsv($output, []);
            fputcsv($output, ['No', 'ID Anggota', 'Nama Siswa', 'Kelas', 'Divisi', 'Status Kehadiran', 'Waktu Presensi', 'Keterangan']);

            $no = 1;
            foreach ($logs as $log) {
                fputcsv($output, [
                    $no++,
                    $log->member->member_code ?? '-',
                    $log->member->name ?? '-',
                    $log->member->class ?? '-',
                    $log->member->division ?? '-',
                    strtoupper($log->status),
                    $log->time ?? '-',
                    $log->notes ?? '-'
                ]);
            }
            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
