<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CVstatus;
use App\Models\UserCV;
use Exception;
use Illuminate\Support\Facades\Mail;




class CVstatusApiController extends Controller

{

    public function apicvstatus()
    {
        try {
            $userCVs = UserCV::with('cvStatus')->get();
            return $this->sendResponse($userCVs, "success");
        } catch (Exception $e) {
            return $this->sendError($e->getmessage());
        }   
    }

    public function indusercv($id){
        try {
          $usercv= UserCV::findorfail($id);
            return $this->sendResponse($usercv, "success");
        } catch (Exception $e) {
            return $this->sendError($e->getmessage());
        }
    }

    public function apiupdatecvstatus(Request $request)
    {
        try {
            
            $task_name = null;
            if ($file = $request->file('task')) {
                $request->validate([
                    'task' => 'mimes:jpeg,png,bmp,pdf',
                ]);

                $task_name = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/task', $task_name);
            }
            CVstatus::updateOrCreate(
                ['cv_id' => $request->cv_id],
                [
                    'status' => $request->status,
                    'task' => $task_name,
                    'interview_date' => $request->interview_date,
                    'interviewers_list' => $request->interviewers_list,
                    'remarks' => $request->remarks,
                ]
            );
            $user = UserCV::where('id', $request->id)->first();
            $cvInstance = CVstatus::where('cv_id', $request->cv_id)->first();
    
            if ($cvInstance->status == 'shortlisted') {
                try {
                    $data = [
                        'user' => $user->name,
                        'technology' => $user->technology,
                        'status' => $cvInstance->status,
    
    
                    ];
                    Mail::to($user->email)->send(new \App\Mail\Shortlisted($data));
                } catch (Exception $e) {
                    return response($e->getMessage());
                }
            }
    
            if ($cvInstance->status == 'First Interview' || 'Second Interview' || 'Third Interview') {
                try {
                    $data = [
                        'user' => $user->name,
                        'technology' => $user->technology,
                        'status' => $cvInstance->status,
                        'interview_date' => $cvInstance->interview_date,
                        'interviewers_list' => $cvInstance->interviewers_list,
                        'task' => $cvInstance->$task_name,
    
                    ];
    
                    Mail::to($user->email)->send(new \App\Mail\Interview($data));
                } catch (Exception $e) {
                    return response($e->getMessage());
                }
            }
            if ($cvInstance->status == 'Hired') {
                try {
                    $data = [
                        'user' => $user->name,
                        'technology' => $user->technology,
                        'status' => $cvInstance->status,
    
                    ];
    
                    Mail::to($user->email)->send(new \App\Mail\Hired($data));
                } catch (Exception $e) {
                    return response($e->getMessage());
                }
            }
    
    
            if ($cvInstance->status == 'Rejected') {
                try {
                    $data = [
                        'user' => $user->name,
                        'technology' => $user->technology,
                        'status' => $cvInstance->status,
    
                    ];
                    Mail::to($user->email)->send(new \App\Mail\Rejected($data));
                } catch (Exception $e) {
                    return response($e->getMessage());
                }
            }
    

            return response()->json(['message' => 'CVstatus updated  successfully']);
        } catch (Exception $e) {

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function apideletecvstatus($id)
    {
        $userCv = UserCV::find($id);
        $cvStatus = CVstatus::where('cv_id', $id)->first();

        $userCv->delete();
        $cvStatus->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'CV data deleted successfully',
        ], 200);
    }
}
