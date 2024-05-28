<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\File;
use App\Models\SubCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function CourseDetails($id,$slug){

        $course = Course::find($id);
        $goals = Course_goal::where('course_id',$id)->orderBy('id','DESC')->get();

        $ins_id = $course->instructor_id;
        $instructorCourses = Course::where('instructor_id',$ins_id)->orderBy('id','DESC')->get();

        $categories = Category::latest()->get();

        $cat_id = $course->category_id;
        $relatedCourses = Course::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(3)->get();

        return view('frontend.course.course_details',compact('course','goals','instructorCourses','categories','relatedCourses'));

    } // End Method

    public function AllCourses(){

        $courses = Course::all();
        $categories =Category::all();
        return view('frontend.course.all_courses',compact('courses', 'categories'));

    } // End Method

    public function CategoryCourse($id, $slug){

        $courses = Course::where('category_id',$id)->where('status','1')->get();
        $category = Category::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.category_all',compact('courses','category','categories'));
    }// End Method


    public function SubCategoryCourse($id, $slug){

        $courses = Course::where('subcategory_id',$id)->where('status','1')->get();
        $subcategory = SubCategory::where('id',$id)->first();
        $categories = Category::latest()->get();
        return view('frontend.category.subcategory_all',compact('courses','subcategory','categories'));
    }// End Method


    public function InstructorDetails($id){

        $instructor = User::find($id);
        $courses = Course::where('instructor_id',$id)->get();
        return view('frontend.instructor.instructor_details',compact('instructor','courses'));

    }// End Method

    public function UserUploadFiles($id){
        $instructor = User::find($id);
        return view('frontend.home.register-area',compact('instructor'));
    }// End Method

    public function UserUploadFileGet(Request $request){
        $request->validate([
            'tester_id' => 'required',
        ]);
        $instructor = User::find($request -> tester_id);
        $files = File::where('instructor_id', $request -> tester_id) ->orderBy('id', 'desc')->get();
        return view('frontend.add_file',compact('instructor','files'));
    }// End Method

    public function UserStoreFile(Request $request)
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
        return redirect()->back()->with($notification);
    }// End Method

    public function PlayerManager(Request $request){
        $request->validate([
            'player_ip' => 'required',
        ]);
        $playerip = $request -> player_ip;
        return view('frontend.player_manager',compact('playerip'));
    }// End Method

    public function PlayerScanner(Request $request){
        $result = Process::run('nmap -sn 192.168.120.0/24');
        dd($result->output());

        exec('ipconfig', $out);
        $str = '';
        foreach ($out as $key => $cmd) {
            if(str_contains($cmd, '192.168')) {
                $str = $cmd;
            }
        }
        $arr= explode('.',substr($str, 39));
        $command = "nmap -sn " . $arr[0]."." . $arr[1] . "." . $arr[2] . ".0/24";
        exec($command, $output);
        $array = [];
        foreach ($output as $key => $data) {
            if (Str::contains($data, 'MAC Address:')) {
                array_push($array, (object)['ip' => $output[$key - 2], 'mac_address' => $output[$key]]);
            }
        }
        return view('frontend.player_scanner', compact('array'));
    }// End Method

    public function ScannerScan(Request $request)
    {

//        $array = array('foo' => 'bar');
//        foreach ($output as $key => $data) {
//            if ( Str::contains($data, 'MAC Address:')){
//                $array = array_add(['ip' => 'mac_address'], $output[$key-2], $output[$key]);
//            }
//        }
//        dd($result);

//        $notification = array(
//            'message' => 'Successfully',
//            'alert-type' => 'success'
//        );
        return view('frontend.player_manager',compact('output'));

//        return redirect()->back()->with($notification);
    }// End Method
}
