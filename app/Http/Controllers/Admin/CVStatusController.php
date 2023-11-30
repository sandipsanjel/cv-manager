<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCV;
use App\Models\CVstatus;



class CVStatusController extends Controller
{

    public function store(Request $request)
    {
        $CVstatus=new CVstatus;
        $CVstatus->status=$request->input('status');
        // $CVstatus->task=$request->input('task');
        $CVstatus->interview_date=$request->input('interview_date');
        $CVstatus->interviewers_list=$request->input('interviewers_list');
        $CVstatus->remarks=$request->input('remarks');


        if ($request->hasFile('task')) {
            $documentPath = $request->file('task')->store('task');
            $CVstatus->task = $documentPath;
        }
        // try {
            $CVstatus->save();
        // } catch (\Exception $e) {
        //     // Log or handle the exception
        //     return redirect()->back();
        // }
        // Redirect back or to a success page
        return redirect()->route('user_cv.index');
    }
}
