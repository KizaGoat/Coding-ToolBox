<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Group;

class DashboardController extends Controller
{
    public function index()
    {
        $userRole = auth()->user()->school()->pivot->role;

        // Récupération des données à afficher dans le dashboard
        $data = [
            'promotionsCount' => Promotion::count(),
            'studentsCount'   => Student::count(),
            'teachersCount'   => Teacher::count(),
            'groupsCount'     => Group::count(),
        ];

        return view('pages.dashboard.dashboard-' . $userRole, $data);
    }
}
