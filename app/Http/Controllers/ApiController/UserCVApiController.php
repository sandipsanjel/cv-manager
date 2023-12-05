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
        // try {
        //     $userCVs = UserCV::with('cvStatus')->get();
        //     // dd($userCVs);
        //     return $this->sendResponse($userCVs, 'Success');
        // } catch (Exception $e) {
        //     return $this->sendError($e->getMessage());
        // }

        $cvs = UserCV::orderByDesc('id')->get();


        if ($cvs->count() == 0) {

            $response = [
                "message" => "Empty Database",
                "status" => 404,
                "statusText" => "error"
            ];
            return response()->json($response);
        } else {

            $response = [
                [
                    "data" => "",
                    "success" => true,
                ],
                [
                    "data" => $cvs->toArray(),
                    "message" => "Cv list retrieved successfully.",
                    "status" => 200,
                    "statusText" => "OK"
                ]
            ];

            return response()->json($response);
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

        return $this->sendSuccess('Success  ');
    }

    public function apiuserslist()
    {

        //     $user = User::all();

        //     if ($user->count() == 0) {
        //         $response =
        //             [
        //                 "message" => "Empty Database",
        //                 "status" => 404,
        //                 "statusText" => "error"
        //             ];
        //         return response()->json($response);
        //     } else {
        //         $response =
        //             [
        //                 "data" => $user->toArray(),
        //                 "messaage" => "user list retrived sucessfully",
        //                 "status" => 200,
        //                 "statustext" => "OK"
        //             ];
        //         return response()->json($response);
        //     }

        $users = User::all();

        return response()->json(['users' => $users], 200);
    }


    public function apiuserslogin(Request $request)
    {
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

        return response($response, 201);
    }
    public function apiuserssignup(Request $request)
    {

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
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
