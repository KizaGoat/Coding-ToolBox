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

class CohortController extends Controller
{
    /**
     * Display all available cohorts
     */
    public function index()
    {
        $cohorts = Cohort::all();
        return view('pages.cohorts.index', compact('cohorts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'start_date' => 'required|date',  // Validation pour la date de début
            'end_date' => 'required|date',    // Validation pour la date de fin
        ]);

        // Création d'une nouvelle promotion (Cohort)
        $cohort = new Cohort();
        $cohort->name = $request->input('name');
        $cohort->description = $request->input('description');
        $cohort->start_date = $request->input('start_date');  // Récupération de la date de début
        $cohort->end_date = $request->input('end_date');// Récupération de la date de fin
        $cohort->school_id = 1; // à adapter selon l'école liée ou l'utilisateur connecté

        $cohort->save(); // Sauvegarde dans la base de données

        return redirect()->route('cohort.index')->with('success', 'La promo a été créée avec succès');
    }


    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {

        return view('pages.cohorts.show', [
            'cohort' => $cohort
        ]);
    }
}
