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

        $user_schools = UserSchool::where('role', 'student')
            ->whereHas('user')
            ->with('user')
            ->get();
        return view('pages.students.index', compact('user_schools'));
    }

    public function store(Request $request)
    {
        // validate the request data
        $request->validate([

            'name' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'year' => 'required|date',
        ]);

        // create new user
        $user = new User();
        $user->first_name = $request->input('Prenom');
        $user->last_name = $request->input('name');
        $user->email = $request->input('Email');
        $user->password = Hash::make('12345678');
        $user->birth_date = $request->input('year');
        $user->save();


        // associate one user to one school and give him student role
        $user_school = new UserSchool();
        $user_school->user_id = $user->id;
        $user_school->school_id = 1;
        $user_school->role = 'student';
        $user_school->save();



        return redirect()->route('student.index')->with('success', 'L\'étudiant a été créé avec succès');
    }

    public function update(Request $request, $id)
    {
        // Validate form data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
        ]);

        // Find student by ID
        $student = UserSchool::findOrFail($id);

        // Update student data
        $student->user->first_name = $validated['first_name'];
        $student->user->last_name = $validated['last_name'];
        $student->user->email = $validated['email'];
        $student->user->birth_date = $validated['birth_date'];

        // Save changes
        $student->user->save();

        // Redirect with success message
        return redirect()->route('student.index')->with('success', 'Les informations de l\'étudiant ont été mises à jour avec succès.');
    }

    // this function is used for delete any column
    public function destroy($id)
    {
        $user_school = UserSchool::findOrFail($id);
        $user_school->delete();

        return redirect()->route('student.index')->with('success', 'etudiant supprimée avec succès');
    }

    // this function is used for edit any column
    public function edit(Request $request, $id)
    {

    }
}
