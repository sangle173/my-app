<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Team;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function AllAction()
    {

        $actions = Action::latest()->get();
        return view('admin.backend.action.all_action', compact('actions'));

    }// End Method

    public function AddAction()
    {
        return view('admin.backend.action.add_action');
    }// End Method

    public function StoreAction(Request $request)
    {

        Action::insert([
            'action_name' => $request->action_name,
            'color' => $request->color,
            'icon' => $request->icon,
            'action_slug' => strtolower(str_replace(' ', '-', $request->action_name)),
        ]);

        $notification = array(
            'message' => 'Action Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.action')->with($notification);

    }// End Method

    public function EditAction($id)
    {

        $action = Action::find($id);
        return view('admin.backend.action.edit_action', compact('action'));
    }// End Method

    public function UpdateAction(Request $request)
    {

        $action_id = $request->id;
        Action::find($action_id)->update([
            'action_name' => $request-> action_name,
            'color' => $request->color,
            'icon' => $request->icon,
            'action_slug' => strtolower(str_replace(' ', '-', $request-> action_name)),
        ]);

        $notification = array(
            'message' => 'Action Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.action')->with($notification);
    }// End Method


    public function DeleteAction($id)
    {

        $item = Action::find($id);

        Action::find($id)->delete();

        $notification = array(
            'message' => 'Action Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
