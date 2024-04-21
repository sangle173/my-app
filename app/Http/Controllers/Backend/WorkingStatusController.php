<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WorkingStatus;
use Illuminate\Http\Request;

class WorkingStatusController extends Controller
{
    public function AllWorkingStatus()
    {

        $working_status = WorkingStatus::latest()->get();
        return view('admin.backend.working_status.all_working_status', compact('working_status'));

    }// End Method

    public function AddWorkingStatus()
    {
        return view('admin.backend.working_status.add_working_status');
    }// End Method

    public function StoreWorkingStatus(Request $request)
    {

        WorkingStatus::insert([
            'working_status_name' => $request->working_status_name,
            'color' => $request->color,
            'working_status_slug' => strtolower(str_replace(' ', '-', $request->working_status_name)),
        ]);

        $notification = array(
            'message' => 'Working Status Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.workingstatus')->with($notification);

    }// End Method

    public function EditWorkingStatus($id)
    {

        $working_status = WorkingStatus::find($id);
        return view('admin.backend.working_status.edit_working_status', compact('working_status'));
    }// End Method

    public function UpdateWorkingStatus(Request $request)
    {

        $working_status_id = $request->id;
        WorkingStatus::find($working_status_id)->update([
            'working_status_name' => $request-> working_status_name,
            'color' => $request->color,
            'working_status_slug' => strtolower(str_replace(' ', '-', $request-> working_status_name)),
        ]);

        $notification = array(
            'message' => 'Working Status Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.workingstatus')->with($notification);
    }// End Method


    public function DeleteWorkingStatus($id)
    {

        WorkingStatus::find($id)->delete();

        $notification = array(
            'message' => 'Working Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
