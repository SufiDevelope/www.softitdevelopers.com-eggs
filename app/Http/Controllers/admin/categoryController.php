<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use Session;
// for image
use Illuminate\Support\Facades\Storage;


class categoryController extends Controller
{
    //
    public function showCategory(){
        Session::put('page','categories');
        $category = category::with('parentCategory')->get();
        return view('admin.categories.categories')->with(compact('category'));
    }

    public function categoryStatus(Request $request)
    {
       if($request->ajax()){
            $data = $request->all();
            // print_r($data);die;
            if($data['status']=='Active'){
                $status = 0;
            }
            else{
                $status = 1;
            }
            category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
       }
    }

     public function destroy($id)
    {
        category::where('id',$id)->delete();
        return redirect()->back()->with('success','Category has been deleted successfully!');
    }

    public function edit(Request $req,$id=null){
        if($id=""){
            $title = "Add Category";
        }
        else{
            $title = "Edit Category";
        }

        

        if($req->isMethod('post')){
            $data = $req->all();
            // dd($data);
            // die;
            $validated = $req->validate([
            'category_name' => 'required',
            'url' => 'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required',
        ]);

            $category = new category;
            $category->category_name = $req->category_name;
            $imagePath = ""; 

           if ($req->hasFile('category_image')) {
                $image = $req->file('category_image');
                $imagePath = $image->store('public/admin/images/category');
                $imageUrl = Storage::url($imagePath);
                $category->category_image = $imageUrl;
            } elseif (!empty($data['current_image'])) {
                $category->category_image = $data['current_image'];
            }
            $category->category_discount = $req->discount;
            $category->description = $req->description;
            $category->url = $req->url;
            $category->meta_title = $req->meta_title;
            $category->meta_description = $req->meta_description;
            $category->meta_keywords = $req->meta_keywords;
            $category->status = 1;
            $category->save();
            return redirect('/admin/categories')->with('success','Congratulation! Category Created Successfully.');

            
        }
        return view('admin.categories.add-edit-category')->with(compact('title'));
    }
}
