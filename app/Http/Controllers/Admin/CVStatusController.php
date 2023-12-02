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

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $cvInstance = CVstatus::where('cv_id', $id)->first();
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
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
        DB::commit();
        return redirect('admin/user-cv');
    }
    public function edit($id)
    {
        $cvInstance = USerCV::findorfail($id);
        return view('admin.statuschange', compact('cvInstance'));
    }
    public function delete($id)
    {
        $item = USerCV::find($id);

        if (!$item) {
            return response()->json(['error' => 'Item not found'], 404);
        }
    
        $item->delete();
    
        return response()->json(['message' => 'Item deleted successfully']);
       
    }
}
