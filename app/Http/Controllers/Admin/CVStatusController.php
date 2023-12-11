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
        return view('admin/statuschange', ['cvInstance' => $cvInstance]);
    }
    public function update(Request $request)
    {
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
        /*****Mail trigger *****/
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
