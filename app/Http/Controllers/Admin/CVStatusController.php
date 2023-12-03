<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserCV;
use App\Models\CVstatus;
use Exception;
use Illuminate\Support\Facades\DB;

class CVStatusController extends Controller
{

    public function store(Request $request)
    {
        // dd($request->all());
        // $CVstatus=new CVstatus; 
        // $CVstatus->status=$request->input('status');
        // // $CVstatus->task=$request->input('task');
        // $CVstatus->interview_date=$request->input('interview_date');
        // $CVstatus->interviewers_list=$request->input('interviewers_list');
        // $CVstatus->remarks=$request->input('remarks');

        $CVstatus = CVstatus::create([
            'status' => $request->input('status'),
            'cv_id' => $request->input('cv_id'),
            'interview_date' => $request->input('interview_date'),
            'interviewers_list' => $request->input('interviewers_list'),
            'remarks' => $request->input('remarks'),
        ]);
        if ($request->hasFile('task')) {
            $documentPath = $request->file('task')->store('task');
            $CVstatus->task = $documentPath;
        }
        // try {
        $CVstatus->save();
        // } catch (\Exception $e) {
        // Log or handle the exception
        // return redirect()->back();
        // }
        // Redirect back or to a success page
        return redirect()->route('user_cv.index');
    }
    public function edit($id)
    {
        $cvInstance = USerCV::findorfail($id);
        return view('admin/statuschange', compact('cvInstance'));
    }
    public function update(Request $request, $id)
    {
        // try {
            // DB::beginTransaction();
            // $cvInstance = new CVstatus;
            $cvInstance = CVstatus::where('cv_id', $id)->first();

            // this is the condtion when request doesnot find he recodrd that matches the usrscv id and cvstatus id
            if ($cvInstance === null) {
                $cvInstance = new CVstatus();
                $cvInstance->cv_id = $id;
            }
            $cvInstance->status = $request->status;
            $cvInstance->cv_id = $request->cv_id;
            $cvInstance->interview_date = $request->interview_date;
            $cvInstance->interviewers_list = $request->interviewers_list;
            $cvInstance->remarks = $request->remarks;
            if ($request->hasFile('task')) {
                $documentPath = $request->file('task')->store('task');
                $cvInstance->task = $documentPath;
            }
            $cvInstance->save();
        // // } catch (Exception $e) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => $e->getMessage(),
        //     ]);
        // }
        // DB::commit();
        // dd($cvInstance);
        return redirect('admin/user-cv')->with('success', 'Records updated successfully');
    }
    
    // public function delete($id)
    // {
    //     try {
    //         // Retrieve records from both tables
    //         $userCv = UserCV::find($id);
    //         $cvStatus = CVstatus::where('cv_id', $id)->first();

    //         // Check if records exist
    //         if (!$userCv || !$cvStatus) {
    //             throw new \Exception("Records not found for cv_id: {$id}");
    //         }

    //         // Delete records
    //         $userCv->delete();
    //         $cvStatus->delete();


    //         return redirect('admin/user-cv')->with('success', 'Records deleted successfully');
    //     } catch (\Exception $e) {
    //         return redirect('admin/user-cv')->with('error', $e->getMessage()) ->with('success', 'Records deleted successfully');
    //     }
    // }
       
    }

