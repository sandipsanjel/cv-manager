<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CVstatus;
use App\Models\UserCV;
use Exception;



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
                    'interview_list' => $request->interview_list,
                    'remarks' => $request->remarks,
                ]
            );
          

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
