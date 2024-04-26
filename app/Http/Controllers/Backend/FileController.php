<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\File;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    public function AllFile()
    {

        $id = Auth::user()->id;
        $files = File::where('instructor_id', $id) ->orderBy('id', 'desc')->get();
        return view('instructor.files.all_file', compact('files'));

    }// End Method

    public function ShareFile()
    {
        $files = File::where('share', 1)->orderBy('created_at', 'desc')->get();
        return view('instructor.files.share_file', compact('files'));
    }// End Method

    public function AddFile()
    {
        $currentInstructor = Auth::user();
        return view('instructor.files.add_file', compact('currentInstructor'));
    }// End Method

    public function StoreFile(Request $request)
    {

        $request->validate([
            'files' => 'required',
        ]);

        $files = [];
        if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().'.'.$file -> getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $files[]['name'] = $fileName;
            }
        }

        if ($request-> share == 1) {
            foreach ($files as $key => $file) {
                $file_id = File::insertGetId([
                    'name' => $file['name'],
                    'instructor_id' => $request-> instructor_id,
                    'file_slug' => strtolower(str_replace(' ', '-', $file['name'])),
                    'share' => 1,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        } else {
            foreach ($files as $key => $file) {
                $file_id = File::insertGetId([
                    'name' => $file['name'],
                    'instructor_id' => $request-> instructor_id,
                    'file_slug' => strtolower(str_replace(' ', '-', $file['name'])),
                    'share' => 0,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }


        $notification = array(
            'message' => 'File Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.file')->with($notification);

    }// End Method
//
//    public function EditTeam($id)
//    {
//
//        $team = Team::find($id);
//        return view('admin.backend.team.edit_team', compact('team'));
//    }// End Method
//
//    public function UpdateTeam(Request $request)
//    {
//
//        $team_id = $request->id;
//        Team::find($team_id)->update([
//            'team_name' => $request-> team_name,
//            'color' => $request-> color,
//            'team_slug' => strtolower(str_replace(' ', '-', $request-> team_name)),
//        ]);
//
//        $notification = array(
//            'message' => 'Team Updated Successfully',
//            'alert-type' => 'success'
//        );
//        return redirect()->route('all.team')->with($notification);
//    }// End Method
//
//
    public function DeleteFile($id)
    {

//        $item = File::find($id);
//        $file = $item->name;
//        unlink($file);
        File::find($id)->delete();
        $notification = array(
            'message' => 'File Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

    public function UpdateFileStatus(Request $request){

        $fileId = $request->input('file_id');
        $isChecked = $request->input('is_checked',0);

        $file = File::find($fileId);
        if ($file) {
            $file->share = $isChecked;
            $file->save();
        }

        return response()->json(['message' => 'Update Share File status Successfully!']);
    }// End Method
}
