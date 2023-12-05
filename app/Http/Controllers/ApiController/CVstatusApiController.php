<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CVstatus;
use App\Models\UserCV;


class CVstatusApiController extends Controller

{

    public function apicvstatus(){

        $status = CVstatus::all();

        return response()->json(['status' => $status], 200);
    }

    public function apiupdatecvstatus(Request $request , $id)
    {
         $status = CVstatus::where('cv_id', $id)->first();

            if ($status === null) {
                $status = new CVstatus();
                $status->cv_id = $id;
            }
            $status->status = $request->status;
            $status->cv_id = $request->cv_id;
            $status->interview_date = $request->interview_date;
            $status->interviewers_list = $request->interviewers_list;
            $status->remarks = $request->remarks;
            if ($request->hasFile('task')) {
                $documentPath = $request->file('task')->store('task');
                $status->task = $documentPath;
            }
            $status->save();

            return response()->json([
                'status' => 'success',
                'message' => 'CV data added successfully',
                'data' => $status
            ], 200);
}


}