<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use App\Models\School;
use Illuminate\Support\Facades\Hash;
use App\Models\UserSchool;
use Illuminate\Support\Facades\Auth;

class CohortController extends Controller
{

    public function index()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Assurer que la relation userSchools existe et est une collection, même vide
        $userSchools = $user->userSchools ?? collect();  // Si userSchools est null, on lui attribue une collection vide

        if ($userSchools->isEmpty()) {
            // Si l'utilisateur n'a pas d'écoles associées, on renvoie une vue d'erreur ou une liste vide
            return view('pages.cohorts.index', ['cohorts' => collect()]);
        }

        // Filtrer uniquement les promotions (cohorts) auxquelles l'utilisateur est lié
        $cohorts = $userSchools->flatMap(function ($userSchool) {
            return $userSchool->cohorts;  // Récupère les promotions liées à l'école de l'utilisateur
        });

        // Si l'utilisateur a le rôle 'admin', alors on peut récupérer toutes les promotions
        $role = $userSchools->first()?->role;  // Récupère le rôle de l'utilisateur
        if ($role === 'admin') {
            // Si c'est un administrateur, récupère toutes les promotions
            $cohorts = Cohort::all();
        }

        // Retourner la vue avec les promotions filtrées
        return view('pages.cohorts.index', compact('cohorts'));
    }



    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        // create new cohort
        $cohort = new Cohort();
        $cohort->name = $request->input('name');
        $cohort->description = $request->input('description');
        $cohort->start_date = $request->input('start_date');
        $cohort->end_date = $request->input('end_date');
        $cohort->school_id = 1;
        $cohort->save();

        return redirect()->route('cohort.index')->with('success', 'La promo a été créée avec succès');
    }

    public function update(Request $request, $id)
    {
        // validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // retrieve the cohort to update by its id
        $cohort = Cohort::findOrFail($id);

        // update the cohort fields
        $cohort->name = $request->input('name');
        $cohort->description = $request->input('description');
        $cohort->start_date = $request->input('start_date');
        $cohort->end_date = $request->input('end_date');

        // save the changes to the database
        $cohort->save();



        // redirect to the cohort index page with a success message
        return redirect()->route('cohort.index')->with('success', 'Promotion mise à jour avec succès');
    }


    // this function is used for delete any column
    public function destroy($id)
    {
        $cohort = Cohort::findOrFail($id);
        $cohort->delete();

        return redirect()->route('cohort.index')->with('success', 'Promotion supprimée avec succès');
    }


    public function show(Cohort $cohort) {

        return view('pages.cohorts.show', [
            'cohort' => $cohort
        ]);
    }


}
