<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Index(){
        $instructors = User::where('role','instructor')->latest()->get();
        $files = File::where('share', 1)->orderBy('created_at', 'desc')->get();
        return view('frontend.index',compact('instructors', 'files'));
    } // End Method

    public function UserProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('frontend.dashboard.edit_profile',compact('profileData'));
    } // End Method

    public function UserProfileUpdate(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);

        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/user_images/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/user_images'),$filename);
           $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Thông tin của bạn đã được cập nhật',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

    public function UserLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Đăng xuất thành công',
            'alert-type' => 'info'
        );

        return redirect('/login')->with($notification);
    } // End Method


    public function UserChangePassword(){
        return view('frontend.dashboard.change_password');
    }// End Method


    public function UserPasswordUpdate(Request $request){

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Mật khẩu cũ không đúng!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        /// Update The new Password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Đổi mật khẩu thành công',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }// End Method


}
