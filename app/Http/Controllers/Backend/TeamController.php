<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function AllTeam()
    {

        $teams = Team::latest()->get();
        return view('admin.backend.team.all_team', compact('teams'));

    }// End Method

    public function AddTeam()
    {
        return view('admin.backend.team.add_team');
    }// End Method

    public function StoreTeam(Request $request)
    {

        Team::insert([
            'team_name' => $request->team_name,
            'color' => $request->color,
            'team_slug' => strtolower(str_replace(' ', '-', $request->team_name)),
        ]);

        $notification = array(
            'message' => 'Team Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);

    }// End Method

    public function EditTeam($id)
    {

        $team = Team::find($id);
        return view('admin.backend.team.edit_team', compact('team'));
    }// End Method

    public function UpdateTeam(Request $request)
    {

        $team_id = $request->id;
        Team::find($team_id)->update([
            'team_name' => $request-> team_name,
            'color' => $request-> color,
            'team_slug' => strtolower(str_replace(' ', '-', $request-> team_name)),
        ]);

        $notification = array(
            'message' => 'Team Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.team')->with($notification);
    }// End Method


    public function DeleteTeam($id)
    {

        $item = Team::find($id);

        Team::find($id)->delete();

        $notification = array(
            'message' => 'Team Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
