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
        // Récupérer l'enseignant via UserSchool pour avoir accès à la relation avec les cohortes
        $user_school = UserSchool::findOrFail($id);

        // Mettre à jour les informations de l'enseignant
        $user_school->user->last_name = $request->input('last_name');
        $user_school->user->first_name = $request->input('first_name');
        $user_school->user->birth_date = $request->input('birth_date');
        $user_school->user->email = $request->input('email');

        // Sauvegarder les modifications de l'enseignant
        $user_school->user->save();

        // Si des promotions sont sélectionnées, mettre à jour la relation many-to-many
        if ($request->has('cohorts')) {
            // Synchroniser les promotions sélectionnées avec l'enseignant
            $user_school->cohorts()->sync($request->input('cohorts'));
        }

        // Rediriger avec un message de succès
        return redirect()->route('teacher.index')->with('success', 'Les informations de l\'enseignant ont été mises à jour avec succès');
    }

}
