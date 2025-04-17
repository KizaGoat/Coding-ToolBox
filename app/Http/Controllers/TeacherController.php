<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        // Get all teacher linked to the user
        $user_schools = UserSchool::where('role', 'teacher')
            ->whereHas('user')
            ->with('user')
            ->get();
        return view('pages.teachers.index', compact('user_schools'));
    }

    public function store(Request $request)
    {
        // Validate input field
        $request->validate([

            'name' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'year' => 'required|date',
        ]);

        // Create new user
        $user = new User();
        $user->first_name = $request->input('Prenom');
        $user->last_name = $request->input('name');
        $user->email = $request->input('Email');
        $user->password = Hash::make('12345678');
        $user->birth_date = $request->input('year');
        $user->save();


        // link user to one school with teacher role
        $user_school = new UserSchool();
        $user_school->user_id = $user->id;
        $user_school->school_id = 1;
        $user_school->role = 'teacher';
        $user_school->save();

        if ($request->has('cohorts')) {
            $user_school->cohorts()->attach($request->input('cohorts'));
        }





        return redirect()->route('teacher.index')->with('success', 'L\'enseignant a été créé avec succès');
    }

    // this function is used for delete any column
    public function destroy($id)
    {
        $user_school = UserSchool::findOrFail($id);
        $user_school->delete();

        return redirect()->route('teacher.index')->with('success', 'enseignant supprimée avec succès');
    }

    // this function is used for edit any column
    public function update(Request $request, $id)
    {
        // Retrieve the teacher information id
        $teacher = UserSchool::findOrFail($id);

        // Update the teacher user data with the new values from the request
        $teacher->user->last_name = $request->input('last_name');
        $teacher->user->first_name = $request->input('first_name');
        $teacher->user->birth_date = $request->input('birth_date');
        $teacher->user->email = $request->input('email');

        // Save the updated user data to the database
        $teacher->user->save();

        // Redirect back to the teacher list with a success message
        return redirect()->route('teacher.index')->with('success', 'Les informations ont été mises à jour.');  // Success message
    }

}
