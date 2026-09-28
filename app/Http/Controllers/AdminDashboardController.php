<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Attendance;
use App\Models\Finance;
use App\Models\Schedule;
use App\Models\Activity;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('id', 'desc')->get();
        $totalMembers = $members->count();
        $activeMembers = $members->where('status', 'Aktif')->count();
        $unpaidMembers = $members->where('dues_status', '!=', 'Lunas');

        $today = date('Y-m-d');
        $todayAttendances = Attendance::with('member')->where('date', $today)->get();
        $todayHadir = $todayAttendances->where('status', 'hadir')->count();

        $totalIncome = Finance::where('type', 'masuk')->sum('amount');
        $totalExpense = Finance::where('type', 'keluar')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        $recentAttendances = Attendance::with('member')->orderBy('created_at', 'desc')->take(6)->get();
        $recentTransactions = Finance::orderBy('date', 'desc')->take(5)->get();
        $recentMembers = Member::orderBy('id', 'desc')->take(6)->get();

        return view('pages.admin.dashboard', compact(
            'totalMembers',
            'activeMembers',
            'todayHadir',
            'unpaidMembers',
            'totalIncome',
            'balance',
            'recentAttendances',
            'recentTransactions',
            'recentMembers'
        ));
    }
}
