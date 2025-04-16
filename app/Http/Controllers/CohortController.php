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

    public function index()
    {
        // get all cohort from database
        $cohorts = Cohort::all();

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
