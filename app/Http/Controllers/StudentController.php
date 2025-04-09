<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('pages.students.index');
    }
    public function store(Request $request){

            User::create([
                'last_name' => $request['name'],
                'first_name' => $request['name'],
                'email' => $request['email'],
                'password' => $request[''],
            ]);

    }
    public function CountStudents()
    {
        // Récupère le nombre total d'étudiants
        $totalStudents = Student::count();

        // Passe la variable à la vue
        return view('pages.students.index', compact('totalStudents')); // compact() crée un tableau avec 'totalStudents'
    }

}
