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
    public function store(Request $request)
        {

            User::create([
                'last_name' => $request['name'],
                'first_name' => $request['name'],
                'email' => $request['email'],
                'password' => $request[''],
            ]);

        }
    }

