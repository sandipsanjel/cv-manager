<?php

namespace App\Http\Controllers;

use App\Models\CVstatus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCV;



class UserCvController extends Controller
{
    public function index(Request $request)
    {
        $search = $request['search'] ?? "";
        if ($search != "") {
            // $userCVs = UserCV::where('name' , 'like', "%$search%")->orwhere('email', 'like', "%$search%")->get();
            $userCVs = UserCV::where('name', 'like', "%$search%")
                ->orWhereHas('cvStatus', function ($query) use ($search) {
                    $query->where('status', 'like', "%$search%");
                })
                ->get();
        } else {
            $userCVs = UserCV::with('cvstatus')->get();
        }
        $data = compact('userCVs', 'search');
        return view('/admin/index')->with($data);
    }
    // $userCVs = UserCV::with('cvStatus')->get();
    // dd($userCVs);
    // return view('admin/index', ['userCVs' => $userCVs]);




    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'references' => 'required',
            'technology' => 'required',
            'level' => 'required|in:Junior,Mid,Senior',
            'salary_expectation' => 'required',
            'experience_years' => 'required',
            'document' => 'required|mimes:png,jpg,docx,pdf',
        ]);

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
        if ($file = $request->file('document')) {
            $request->validate([
                'document' => 'mimes:jpeg,png,bmp,pdf',
            ]);
            $document_name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/cv', $document_name);
        }
        $userCV->document = $document_name;
        $userCV->save();

        return redirect()->route('user_cv.index');
    }

    public function show($id)
    {
        $userCVs = UserCV::findorfail($id);
        return view('admin/viewcv', compact('userCVs'));
    }

    
}
