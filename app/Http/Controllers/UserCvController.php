<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCV;



class UserCvController extends Controller
{
    public function index()
    {
        $userCVs = UserCV::all();
        return view('admin/index', ['userCVs' => $userCVs]);
    }
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required|email',
        //     'references' => 'required',
        //     'technology' => 'required',
        //     'level' => 'required|in:Junior,Mid,Senior',
        //     'salary_expectation' => 'required',
        //     'experience_years' => 'required',
        //     'document' => 'required', 
        // ]);

        // Store the form data in the database
        $userCV = new UserCV;
        $userCV->name = $request->input('name');
        $userCV->phone = $request->input('phone');
        $userCV->email = $request->input('email');
        $userCV->references = $request->input('references');
        $userCV->technology = $request->input('technology');
        $userCV->level = $request->input('level');
        $userCV->salary_expectation = $request->input('salary_expectation');
        $userCV->experience_years = $request->input('experience_years');

        // Upload and store the document file
        if ($request->hasFile('document')) {
            $documentPath = $request->file('document')->store('document');
            $userCV->document = $documentPath;
        }

        $userCV->save();

        return redirect()->route('user_cv.index')->with('success', 'User CV created successfully!');
    }

   
}
