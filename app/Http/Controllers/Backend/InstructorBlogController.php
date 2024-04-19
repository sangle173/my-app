<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class InstructorBlogController extends Controller
{
   public function InstructorAllBlogCategory(){

    $category = BlogCategory::latest()->get();
    return view('instructor.blogcategory.blog_category',compact('category'));

   }// End Method

   public function StoreBlogCategory(Request $request){

    BlogCategory::insert([
        'category_name' => $request->category_name,
        'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
    ]);

    $notification = array(
        'message' => 'Tạo danh mục bài viết thành công',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);


   }// End Method


   public function InstructorEditBlogCategory($id){

    $categories = BlogCategory::find($id);
    return response()->json($categories);

   }// End Method


   public function InstructorUpdateBlogCategory(Request $request){
    $cat_id = $request->cat_id;

    BlogCategory::find($cat_id)->update([
        'category_name' => $request->category_name,
        'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
    ]);

    $notification = array(
        'message' => 'Chỉnh sửa danh mục thành công',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);


   }// End Method

   public function InstructorDeleteBlogCategory($id){

    BlogCategory::find($id)->delete();

    $notification = array(
        'message' => 'Xóa danh mục thanh công',
        'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);


   }// End Method

   //////////// All Blog Post Method .//

   public function InstructorBlogPost(){
    $post = BlogPost::latest()->get();
    return view('instructor.post.all_post',compact('post'));
   }// End Method


   public function InstructorAddBlogPost(){

    $blogcat = BlogCategory::latest()->get();
    return view('instructor.post.add_post',compact('blogcat'));

   }// End Method

   public function InstructorStoreBlogPost(Request $request){
       $request->validate([
           'blogcat_id' => 'required',
           'post_title' => 'required',
           'long_descp' => 'required',
           'post_image' => 'required',
       ]);
    $image = $request->file('post_image');
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(370,247)->save('upload/post/'.$name_gen);
    $save_url = 'upload/post/'.$name_gen;

    BlogPost::insert([
        'blogcat_id' => $request->blogcat_id,
        'post_title' => $request->post_title,
        'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
        'long_descp' => $request->long_descp,
        'post_tags' => $request->post_tags,
        'post_image' => $save_url,
        'created_at' => Carbon::now(),

    ]);

    $notification = array(
        'message' => 'Tạo bài viết thành công',
        'alert-type' => 'success'
    );
    return redirect()->route('blog.post')->with($notification);

   }// End Method

   public function InstructorEditBlogPost($id){

    $blogcat = BlogCategory::latest()->get();
    $post = BlogPost::find($id);
    return view('instructor.post.edit_post',compact('post','blogcat'));

   }// End Method


   public function InstructorUpdateBlogPost(Request $request){

    $post_id = $request->id;

    if ($request->file('post_image')) {

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,247)->save('upload/post/'.$name_gen);
        $save_url = 'upload/post/'.$name_gen;

        BlogPost::find($post_id)->update([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'post_image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Cập nhật bài viết thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);

    } else {

        BlogPost::find($post_id)->update([
            'blogcat_id' => $request->blogcat_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ','-',$request->post_title)),
            'long_descp' => $request->long_descp,
            'post_tags' => $request->post_tags,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);

    } // end else

}// End Method


public function InstructorDeleteBlogPost($id){

    $item = BlogPost::find($id);
    $img = $item->post_image;
    unlink($img);

    BlogPost::find($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

}// End Method

//public function BlogDetails($slug){
//
//    $blog = BlogPost::where('post_slug',$slug)->first();
//    $tags = $blog->post_tags;
//    $tags_all = explode(',',$tags);
//    $bcategory = BlogCategory::latest()->get();
//    $post = BlogPost::latest()->limit(3)->get();
//    return view('frontend.blog.blog_details',compact('blog','tags_all','bcategory','post'));
//
//}// End Method
//
//public function BlogCatList($id){
//
//    $blog = BlogPost::where('blogcat_id',$id)->get();
//    $breadcat = BlogCategory::where('id',$id)->first();
//    $bcategory = BlogCategory::latest()->get();
//    $post = BlogPost::latest()->limit(3)->get();
//    return view('frontend.blog.blog_cat_list',compact('blog','breadcat','bcategory','post'));
//
//}// End Method
//
//public function BlogList(){
//
//    $blog = BlogPost::latest()->paginate(2);
//    $bcategory = BlogCategory::latest()->get();
//    $post = BlogPost::latest()->limit(3)->get();
//    return view('frontend.blog.blog_list',compact('blog','bcategory','post'));
//
//
//}// End Method
//

}
