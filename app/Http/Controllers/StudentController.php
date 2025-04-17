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
        // Get all student link to the user
        $user_schools = UserSchool::where('role', 'student')
            ->whereHas('user')
            ->with('user')
            ->get();
        $cohorts = \App\Models\Cohort::all();
        return view('pages.students.index', compact('cohorts', 'user_schools'));
    }

    public function store(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'name' => 'required|string|max:255',
            'Prenom' => 'required|string|max:255',
            'Email' => 'required|email|max:255',
            'year' => 'required|date',
            'cohort_id' => 'required|exists:cohorts,id', // Ajout de la validation pour l'ID de la promotion
        ]);

        // Créer un nouvel utilisateur
        $user = new User();
        $user->first_name = $request->input('Prenom');
        $user->last_name = $request->input('name');
        $user->email = $request->input('Email');
        $user->password = Hash::make('12345678');
        $user->birth_date = $request->input('year');
        $user->save();

        // Associer l'utilisateur à une école avec le rôle "student"
        $user_school = new UserSchool();
        $user_school->user_id = $user->id;
        $user_school->school_id = 1; // Assurez-vous que l'ID de l'école est correct
        $user_school->role = 'student';
        $user_school->save();  // Sauvegarde de l'instance UserSchool avant d'attacher une cohorte

        // Lier l'étudiant à une promotion (Cohort)
        // Maintenant que user_school est sauvegardé, tu peux attacher la cohorte à cet enregistrement.
        $user_school->cohorts()->attach($request->input('cohort_id'));

        return redirect()->route('student.index')->with('success', 'L\'étudiant a été créé et associé à une promotion avec succès');
    }

    public function update(Request $request, $id)
    {
        // data required
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'cohorts' => 'required|array',
            'cohorts.*' => 'exists:cohorts,id',
        ]);

        //search student by id
        $user_school = UserSchool::findOrFail($id);

        //upload data of student
        $user_school->user->first_name = $validated['first_name'];
        $user_school->user->last_name = $validated['last_name'];
        $user_school->user->email = $validated['email'];
        $user_school->user->birth_date = $validated['birth_date'];
        $user_school->user->save();

        // upload cohort
        $user_school->cohorts()->sync($validated['cohorts']); // Remplacer l'ancienne promotion par la nouvelle

        return redirect()->route('student.index')->with('success', 'Les informations de l\'étudiant ont été mises à jour avec succès.');
    }


    // this function is used for delete any column
    public function destroy($id)
    {
        $user_school = UserSchool::findOrFail($id);
        $user_school->user()->delete();
        $user_school->delete();

        return redirect()->route('student.index')->with('success', 'etudiant supprimée avec succès');
    }

    // this function is used for edit any column
    public function edit(Request $request, $id)
    {

    }
}
