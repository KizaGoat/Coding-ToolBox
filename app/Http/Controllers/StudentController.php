<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {

        $user_schools = UserSchool::where('role', 'student')->get();
        return view('pages.students.index', compact('user_schools'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'year' => 'required|date',
        ]);

        $user = new User();
        $user->first_name = $request->input('Prenom');
        $user->last_name = $request->input('name');
        $user->email = $request->input('Email');
        $user->password = Hash::make('12345678');
        $user->birth_date = $request->input('year');
        $user->save();



        $user_school = new UserSchool();
        $user_school->user_id = $user->id;
        $user_school->school_id = 1;
        $user_school->role = 'student';
        $user_school->save();



        return redirect()->route('student.index')->with('success', 'L\'étudiant a été créé avec succès');
    }

    public function edit(Request $request, $id)
    {

        // Recuperer le user par l'id
        // Modifier les colonnes
    }
}
