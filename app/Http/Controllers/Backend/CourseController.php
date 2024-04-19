<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use App\Models\Course_goal;
use App\Models\CourseSection;
use App\Models\CourseLecture;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CourseController extends Controller
{
    public function AllCourse()
    {
        $courses = Course::all();
        return view('instructor.courses.all_course', compact('courses'));

    }// End Method

    public function AddCourse()
    {

        $categories = Category::latest()->get();
        $instructors = User::where('role','instructor')->latest()->get();
        $currentInstructor = Auth::user();
        return view('instructor.courses.add_course', compact('categories', 'instructors', 'currentInstructor'));
    }// End Method


    public function GetSubCategory($category_id)
    {

        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subcat);

    }// End Method

    public function StoreCourse(Request $request)
    {

        $request->validate([
            'video' => 'mimes:mp4|max:500000',
            'course_title' => 'required',
            'course_name' => 'required|unique:courses,course_name',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'selling_price' => 'required',
        ]);
        $save_url = null;
        if ($request->file('course_image')) {
            $image = $request->file('course_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 246)->save('upload/course/thambnail/' . $name_gen);
            $save_url = 'upload/course/thambnail/' . $name_gen;
        }

        $save_video = null;
        if ($request->file('video')) {
            $video = $request->file('video');
            $videoName = time().'.'.$video->getClientOriginalExtension();
            $video->move(public_path('upload/course/video/'), $videoName);
            $save_video = 'upload/course/video/' . $videoName;
        }
        $course_id = Course::insertGetId([

            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => $request->instructor_id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,
            'video' => $save_video,

            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,
            'status' => 1,
            'course_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        /// Course Goals Add Form

        $goles = Count($request->course_goals);
        if ($goles != NULL) {
            for ($i = 0; $i < $goles; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $course_id;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }
        }
        /// End Course Goals Add Form

        $notification = array(
            'message' => 'Course Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.course')->with($notification);

    }// End Method


    public function EditCourse($id)
    {

        $course = Course::find($id);
        $goals = Course_goal::where('course_id', $id)->get();
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $instructors = User::where('role','instructor')->latest()->get();
        $currentInstructor = Auth::user();
        return view('instructor.courses.edit_course', compact('course', 'categories', 'subcategories', 'goals', 'instructors', 'currentInstructor'));

    }// End Method


    public function UpdateCourse(Request $request)
    {

        $cid = $request->course_id;

        Course::find($cid)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'instructor_id' => $request->instructor_id,
            'course_title' => $request->course_title,
            'course_name' => $request->course_name,
            'course_name_slug' => strtolower(str_replace(' ', '-', $request->course_name)),
            'description' => $request->description,

            'label' => $request->label,
            'duration' => $request->duration,
            'resources' => $request->resources,
            'certificate' => $request->certificate,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'prerequisites' => $request->prerequisites,

            'bestseller' => $request->bestseller,
            'featured' => $request->featured,
            'highestrated' => $request->highestrated,

        ]);

        $notification = array(
            'message' => 'Cập nhật khóa học thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('all.course')->with($notification);

    }// End Method


    public function UpdateCourseImage(Request $request)
    {

        $course_id = $request->id;
        $oldImage = $request->old_img;

        $image = $request->file('course_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 246)->save('upload/course/thambnail/' . $name_gen);
        $save_url = 'upload/course/thambnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Course::find($course_id)->update([
            'course_image' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Cập nhật ảnh khóa học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function UpdateCourseVideo(Request $request)
    {

        $request->validate([
            'video' => 'required|mimes:mp4|max:500000',
        ]);

        $course_id = $request->vid;
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        $videoName = time() . '.' . $video->getClientOriginalExtension();
        $video->move(public_path('upload/course/video/'), $videoName);
        $save_video = 'upload/course/video/' . $videoName;

        if (file_exists($oldVideo)) {
            unlink($oldVideo);
        }

        Course::find($course_id)->update([
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Cập nhật video khóa học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function UpdateLectureVideo(Request $request)
    {

        $request->validate([
            'video' => 'required|mimes:mp4|max:800000',
        ]);

        $lecture_id = $request->lecture_id;
        $oldVideo = $request->old_vid;

        $video = $request->file('video');
        $videoName = time().'_'.$video->getClientOriginalName();
        $video->move(public_path('upload/course/video/'), $videoName);
        $save_video = 'upload/course/video/' . $videoName;

        if (file_exists($oldVideo)) {
            unlink($oldVideo);
        }

        CourseLecture::find($lecture_id)->update([
            'video' => $save_video,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Cập nhật video bài học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }

    public function UpdateLectureDocument(Request $request)
    {
        $lecture_id = $request-> lecture_id;
        $oldDocs = $request-> old_doc;
        $multiplePaths = "";
        if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('upload/lecture/document/'), $fileName);
                $multiplePaths .= ";".$fileName;
            }
        }

        foreach(explode(';', $oldDocs) as $key => $oldDoc)
        {
            if (file_exists($oldDoc)) {
                unlink($oldDoc);
            }
        }


        CourseLecture::find($lecture_id)->update([
            'url' => Str::replaceFirst(';', '', $multiplePaths),
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Cập nhật tài liệu bài học thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all.lecture', CourseLecture::find($lecture_id) -> course_id)->with($notification);

    }

    public function UpdateCourseGoal(Request $request)
    {

        $cid = $request->id;

        if ($request->course_goals == NULL) {
            return redirect()->back();
        } else {

            Course_goal::where('course_id', $cid)->delete();

            $goles = Count($request->course_goals);

            for ($i = 0; $i < $goles; $i++) {
                $gcount = new Course_goal();
                $gcount->course_id = $cid;
                $gcount->goal_name = $request->course_goals[$i];
                $gcount->save();
            }  // end for
        } // end else

        $notification = array(
            'message' => 'Course Goals Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function DeleteCourse($id)
    {
        $course = Course::find($id);
        unlink($course->course_image);
        unlink($course->video);

        Course::find($id)->delete();

        $goalsData = Course_goal::where('course_id', $id)->get();
        foreach ($goalsData as $item) {
            $item->goal_name;
            Course_goal::where('course_id', $id)->delete();
        }

        $notification = array(
            'message' => 'Course Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function AddCourseLecture($id)
    {

        $section = CourseSection::find($id);
        $course = Course::find($section -> course_id);

        return view('instructor.courses.lecture.add_lecture', compact('section', 'course'));

    }// End Method

    public function AllCourseLecture($id)
    {

        $course = Course::find($id);

        $section = CourseSection::where('course_id', $id)->latest()->get();

        return view('instructor.courses.section.all_section', compact('course', 'section'));
    }// End Method

    public function AddCourseSectionGet($id)
    {

        $course = Course::find($id);
        return view('instructor.courses.section.add_section', compact('course'));

    }// End Method

    public function EditCourseSectionGet($id)
    {
        $section = CourseSection::find($id);
        return view('instructor.courses.section.edit_section', compact('section'));

    }// End Method

    public function AddCourseSection(Request $request)
    {
        $cid = $request->id;
        $request->validate([
            'section_video' => 'mimes:mp4|max:500000',
            'section_title' => 'required',
        ]);
        $save_video = null;
        $save_document = null;
        if ($request->file('section_video')) {
            $video = $request->file('section_video');
            $videoName = time().'.'.$video->getClientOriginalExtension();
            $video->move(public_path('upload/lecture/video/'), $videoName);
            $save_video = 'upload/lecture/video/' . $videoName;
        }

        if ($request->file('section_document')) {
            $document = $request->file('section_document');
            $documentName = time().'.'.$document->getClientOriginalExtension();
            $document->move(public_path('upload/lecture/document/'), $documentName);
            $save_document = 'upload/lecture/document/' . $documentName;
        }

        CourseSection::insert([
            'course_id' => $cid,
            'section_title' => $request->section_title,
        ]);

        $notification = array(
            'message' => 'Thêm mới chương thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all.lecture', $cid)->with($notification);
    }// End Method

    public function SaveLecture(Request $request)
    {
        $course_id = $request->course_id;
        $section_id = $request->section_id;
        $request->validate([
            'lecture_video' => 'mimes:mp4|max:800000',
            'lecture_title' => 'required',
        ]);
        $save_video = null;
        $save_document = null;
        if ($request->file('lecture_video')) {
            $video = $request->file('lecture_video');
            $videoName = time().'_'.$video->getClientOriginalName();
            $video->move(public_path('upload/lecture/video/'), $videoName);
            $save_video = 'upload/lecture/video/' . $videoName;
        }

        $multiplePaths = "";
        if ($request->file('files')){
            foreach($request->file('files') as $key => $file)
            {
                $fileName = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('upload/lecture/document/'), $fileName);
                $multiplePaths .= ";".$fileName;
            }
        }

        CourseLecture::insert([
            'course_id' => $course_id,
            'section_id' => $section_id,
            'lecture_title' => $request->lecture_title,
            'content' => $request->lecture_content,
            'video' => $save_video,
            'url' => Str::replaceFirst(';', '', $multiplePaths),
            'status' => $request->lecture_status,
        ]);

        $notification = array(
            'message' => 'Thêm mới bài học thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all.lecture', $course_id)->with($notification);
    }// End Method


    public function EditLecture($id)
    {

        $lecture = CourseLecture::find($id);
        return view('instructor.courses.lecture.edit_course_lecture', compact('lecture'));

    }// End Method


    public function UpdateCourseSection(Request $request)
    {
        $lid = $request-> id;
        $course = Course::find(CourseSection::find($lid) -> course_id);
        $request->validate([
            'section_title' => 'required',
        ]);

        CourseSection::find($lid)->update([
            'section_title' => $request->section_title
        ]);

        $notification = array(
            'message' => 'Cập nhật chương thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all.lecture', $course -> id)->with($notification);

    }// End Method

    public function UpdateCourseLecture(Request $request)
    {
        $lid = $request->id;
        $course = Course::find(CourseLecture::find($lid) -> course_id);
        $request->validate([
            'lecture_title' => 'required',
        ]);

        CourseLecture::find($lid)->update([
            'lecture_title' => $request->lecture_title,
            'content' => $request->lecture_content,
            'status' => $request->lecture_status
        ]);

        $notification = array(
            'message' => 'Cập nhật bài học thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('course.all.lecture', $course -> id)->with($notification);

    }// End Method


    public function DeleteLecture($id)
    {

        CourseLecture::find($id)->delete();

        $notification = array(
            'message' => 'Xóa bài học thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

    public function DeleteSection($id)
    {

        $section = CourseSection::find($id);
        $section->delete();

        $notification = array(
            'message' => 'Xóa chương thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method

    public function UpdateCourseStatus(Request $request){

        $courseId = $request->input('course_id');
        $isChecked = $request->input('is_checked',0);

        $course = Course::find($courseId);
        if ($course) {
            $course->status = $isChecked;
            $course->save();
        }

        return response()->json(['message' => 'Cập nhật trạng thái khóa học thành công!']);
    }// End Method
}
