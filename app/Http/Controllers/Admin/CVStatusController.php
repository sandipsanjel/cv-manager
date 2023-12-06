<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCV;
use App\Models\CVstatus;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;



class CVStatusController extends Controller
{

    public function edit($id)
    {
        $cvInstance = USerCV::findorfail($id);
        return view('admin/statuschange', ['cvInstance' => $cvInstance ]);
    }
    public function update(Request $request)
    {

        CVstatus::updateOrCreate(
            ['cv_id' => $request->id],
            [
                'status' => $request->status,
                'interview_date' => $request->interview_date,
                'interview_list' => $request->interview_list,
                'remarks' => $request->remarks,

            ]
        );

/*****Mail trigger *****/
        $user = UserCV::where('id', $request->id)->first();
        $cvInstance = CVstatus::where('cv_id', $request->cv_id)->first();

        if ($cvInstance->status == 'Hired') {
            try {
                $detials = [
                    'user' => $user->name,
                    'technology' => $user->technology,
                    'status' => $cvInstance->status,
                    'interview_date' => $cvInstance->interview_date,
                    'interviewers_list' => $cvInstance->interviewers_list,

                ];

                Mail::to($user->email)->send(new \App\Mail\Hired($detials));
            } catch (Exception $e) {
                return response($e->getMessage());
            }
        }
        return redirect('admin/user-cv');
    }

    public function delete($id)
    {
            $userCv = UserCV::find($id);
            $cvStatus = CVstatus::where('cv_id', $id)->first();

                $userCv->delete();
                $cvStatus->delete();

                return redirect('admin/user-cv');
    }
        
}
