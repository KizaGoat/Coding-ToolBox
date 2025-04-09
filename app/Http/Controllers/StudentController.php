<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.students.index');

        $students = Student::all();
        return view('students.index', compact('students'));
    }
    public function store(Request $request){


            $request->validate([
                'name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:students,email',
                'promotion_id' => 'required|exists:promotions,id',
            ]);

            Student::create([
                'first_name' => $request['first_name'],
                'last_name' => $request['name'],
                'email' => $request['email'],
                'promotion_id' => $request['promotion_id'],
            ]);

            return redirect()->route('students.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    public function destroy($id)
    {

        $student = Student::findOrFail($id);

        $student->delete();

        return redirect()->route('students.index')->with('success', 'Étudiant supprimé avec succès.');
    }


}
