<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSchool;
use App\Models\Cohort;


class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = UserSchool::where('role', 'student')->count();

        $totalproms = Cohort::count();

        $totalgroups = UserSchool::where('role', 'student', 'group')->count();

        $totalteacher = UserSchool::where('role', 'teacher',)->count();

        return view('pages.dashboard.dashboard-admin', compact('totalStudents', 'totalproms', 'totalgroups', 'totalteacher' ));
    }
}
