<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\Activity;
use App\Models\Announcement;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $activeMembers = Member::where('status', 'Aktif')->count();
        $schedulesCount = Schedule::count();
        $activitiesCount = Activity::count();
        
        $today = date('Y-m-d');
        $todayAttendances = Attendance::where('date', $today)->get();
        $hadirCount = $todayAttendances->where('status', 'hadir')->count();
        $attendanceRate = $totalMembers > 0 ? round(($hadirCount / $totalMembers) * 100) : 0;

        $upcomingSchedules = Schedule::orderBy('date', 'asc')->take(3)->get();
        $announcements = Announcement::orderBy('created_at', 'desc')->take(3)->get();
        $activities = Activity::orderBy('created_at', 'desc')->take(3)->get();

        return view('pages.home', compact(
            'totalMembers',
            'activeMembers',
            'schedulesCount',
            'activitiesCount',
            'attendanceRate',
            'upcomingSchedules',
            'announcements',
            'activities'
        ));
    }
}
