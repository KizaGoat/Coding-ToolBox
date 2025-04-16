<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserSchool;
use App\Models\Cohort;


class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth() ->user()->school() ->pivot-> role;

        $totalStudents = UserSchool::where('role', 'student')->count();

        $totalproms = Cohort::count();

        $totalgroups = UserSchool::where('role', 'student', 'group')->count();

        $totalteacher = UserSchool::where('role', 'teacher')->count();

        return view('pages.dashboard.dashboard-' . $userRole, compact('totalStudents', 'totalproms', 'totalgroups', 'totalteacher' ));
    }
}
