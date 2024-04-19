<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Intervention\Image\Facades\Image;

class InstructorCategoryController extends Controller
{
    public function AllCategory(){

        $category = Category::latest()->get();
        return view('instructor.category.all_category',compact('category'));

    }// End Method

    public function AddCategory(){
        return view('instructor.category.add_category');
    }// End Method

    public function StoreCategory(Request $request){
        $request->validate([
            'category_name' => 'required'
        ]);
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(370,246)->save('upload/category/'.$name_gen);
        $save_url = 'upload/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
            'image' => $save_url,

        ]);

        $notification = array(
            'message' => 'Thêm mới danh mục thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.category')->with($notification);

    }// End Method


    public function EditCategory($id){

        $category = Category::find($id);
        return view('instructor.category.edit_category',compact('category'));
    }// End Method

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(370,246)->save('upload/category/'.$name_gen);
            $save_url = 'upload/category/'.$name_gen;

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),
                'image' => $save_url,

            ]);

            $notification = array(
                'message' => 'Cập nhật danh mục thành công',
                'alert-type' => 'success'
            );
            return redirect()->route('instructor.all.category')->with($notification);

        } else {
            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ','-',$request->category_name)),

            ]);

            $notification = array(
                'message' => 'Cập nhật danh mục thành công',
                'alert-type' => 'success'
            );
            return redirect()->route('instructor.all.category')->with($notification);

        } // end else

    }// End Method


    public function DeleteCategory($id){

        $item = Category::find($id);
        $img = $item->image;
        unlink($img);

        Category::find($id)->delete();

            $notification = array(
                'message' => 'Xóa danh mục thành công',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

    }// End Method

    ////////// All SubCategory Methods //////////////

    public function AllSubCategory(){

        $subcategory = SubCategory::latest()->get();
        return view('instructor.subcategory.all_subcategory',compact('subcategory'));

    }// End Method


    public function AddSubCategory(){

        $category = Category::latest()->get();
        return view('instructor.subcategory.add_subcategory',compact('category'));

    }// End Method


    public function StoreSubCategory(Request $request){
        $request->validate([
            'subcategory_name' => 'required',
        ]);
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),

        ]);

        $notification = array(
            'message' => 'Tạo mới danh mục con thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.subcategory')->with($notification);

    }// End Method


    public function EditSubCategory($id){

        $category = Category::latest()->get();
        $subcategory = SubCategory::find($id);
        return view('instructor.subcategory.edit_subcategory',compact('category','subcategory'));

    }// End Method


    public function UpdateSubCategory(Request $request){

        $subcat_id = $request->id;

        SubCategory::find($subcat_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ','-',$request->subcategory_name)),

        ]);

        $notification = array(
            'message' => 'Cập nhật danh mục con thành công',
            'alert-type' => 'success'
        );
        return redirect()->route('instructor.all.subcategory')->with($notification);

    }// End Method


    public function DeleteSubCategory($id){

        SubCategory::find($id)->delete();

        $notification = array(
            'message' => 'Xóa danh mục con thành công',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

}
