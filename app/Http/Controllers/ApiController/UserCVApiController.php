<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserCV;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserCVApiController extends Controller
{
    public function apiindex()
    {
        try {
            $userCVs = UserCV::with('cvStatus')->get();
            // dd($userCVs);
            return $this->sendResponse($userCVs, 'Success');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function apistore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'references' => 'required',
            'technology' => 'required',
            'level' => 'required|in:Junior,Mid,Senior',
            'salary_expectation' => 'required',
            'experience_years' => 'required',

        ]);

        $userCV = new UserCV;
        $userCV->name = $request->input('name');
        $userCV->phone = $request->input('phone');
        $userCV->email = $request->input('email');
        $userCV->references = $request->input('references');
        $userCV->technology = $request->input('technology');
        $userCV->level = $request->input('level');
        $userCV->salary_expectation = $request->input('salary_expectation');
        $userCV->experience_years = $request->input('experience_years');

        if ($file = $request->file('document')) {
            $request->validate([
                'document' => 'mimes:jpeg,png,bmp,pdf',
            ]);
            $document_name = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/cv', $document_name);
        }
        $userCV->document = $document_name;

        $userCV->save();


        return $this->sendSuccess('Success');
    }

    public function apiuserslist()
    {

        try {
            $users = User::all();
            return $this->sendResponse($users, 'Success');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }


    public function apiuserslogin(Request $request)
    {
        try {
            $data = $request->validate([
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

            $user = User::where('email', $data['email'])->first();

            if (!$user || !Hash::check($data['password'], $user->password)) {
                return response([
                    'msg' => 'incorrect username or password'
                ], 401);
            }

            $token = $user->createToken('apiToken')->plainTextToken;

            $response = [
                'user' => $user,
                'token' => $token
            ];

            return $this->sendResponse($response, 'success');
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }
    }

    public function apiuserssignup(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:table,column,except,id',
            'password' => 'required|string'
        ]);

        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);
        $token = $user->createToken('apiToken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
}
