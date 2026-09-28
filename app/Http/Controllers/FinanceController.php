<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Models\Member;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FinanceController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Finance::orderBy('date', 'desc')->orderBy('created_at', 'desc')->get();
        $members = Member::orderBy('name', 'asc')->get();

        $totalIncome = Finance::where('type', 'masuk')->sum('amount');
        $totalExpense = Finance::where('type', 'keluar')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $totalMembers = $members->count();
        $paidMembersCount = $members->where('dues_status', 'Lunas')->count();
        $unpaidMembersCount = $members->where('dues_status', '!=', 'Lunas')->count();
        $paidRate = $totalMembers > 0 ? round(($paidMembersCount / $totalMembers) * 100) : 0;

        return view('pages.finances.index', compact(
            'transactions',
            'members',
            'balance',
            'totalIncome',
            'totalExpense',
            'totalMembers',
            'paidMembersCount',
            'unpaidMembersCount',
            'paidRate'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:masuk,keluar',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:1000',
            'date' => 'required|date',
            'payment_method' => 'required|string',
            'member_id' => 'nullable|exists:members,id',
            'member_name' => 'nullable|string',
            'period' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $nextNum = Finance::count() + 1;
        $trxCode = 'TRX-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        $memberName = $validated['member_name'] ?? null;
        if (!empty($validated['member_id'])) {
            $member = Member::find($validated['member_id']);
            if ($member) {
                $memberName = $member->name;
                if ($validated['type'] === 'masuk') {
                    $member->update(['dues_status' => 'Lunas']);
                }
            }
        }

        Finance::create([
            'trx_code' => $trxCode,
            'member_id' => $validated['member_id'] ?? null,
            'member_name' => $memberName,
            'type' => $validated['type'],
            'category' => $validated['category'],
            'amount' => $validated['amount'],
            'period' => $validated['period'] ?? 'September 2026',
            'payment_method' => $validated['payment_method'],
            'status' => 'Lunas',
            'date' => $validated['date'],
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('finances.index')->with('success', "Transaksi {$trxCode} berhasil dicatat!");
    }

    public function markPaid(Request $request, Member $member)
    {
        $member->update(['dues_status' => 'Lunas']);

        $nextNum = Finance::count() + 1;
        Finance::create([
            'trx_code' => 'TRX-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT),
            'member_id' => $member->id,
            'member_name' => $member->name,
            'type' => 'masuk',
            'category' => 'Iuran Bulanan',
            'amount' => 25000,
            'period' => date('F Y'),
            'payment_method' => 'Tunai',
            'status' => 'Lunas',
            'date' => date('Y-m-d'),
            'description' => 'Pelunasan iuran bulanan ' . date('F Y'),
        ]);

        return redirect()->route('finances.index')->with('success', "Iuran anggota {$member->name} berhasil ditandai Lunas!");
    }

    public function export(): StreamedResponse
    {
        $transactions = Finance::orderBy('date', 'desc')->get();

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="laporan_kas_sac_' . date('Ymd_His') . '.csv"',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($transactions) {
            $output = fopen('php://output', 'w');
            fputs($output, "\xEF\xBB\xBF");
            fputcsv($output, ['LAPORAN KEUANGAN KAS SMECONE ARCHERY CLUB']);
            fputcsv($output, ['Tanggal Unduh: ' . date('d F Y H:i:s')]);
            fputcsv($output, []);
            fputcsv($output, ['Kode TRX', 'Tanggal', 'Tipe', 'Kategori', 'Keterangan/Penyetor', 'Metode', 'Status', 'Nominal (Rp)']);

            foreach ($transactions as $t) {
                fputcsv($output, [
                    $t->trx_code,
                    $t->date,
                    strtoupper($t->type),
                    $t->category,
                    $t->member_name ?? $t->description ?? '-',
                    $t->payment_method,
                    $t->status,
                    ($t->type === 'masuk' ? '+' : '-') . $t->amount
                ]);
            }
            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
