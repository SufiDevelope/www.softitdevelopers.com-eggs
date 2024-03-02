<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use App\Models\adminsRole;
use Illuminate\Http\Request;
use Session;
use Auth;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page','cms_pages');
        $cmsPages = CmsPage::all();

        // set roles and permission for Cms Pages
        $cmspagesModuleCount = adminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->count();
        $pagesModule = array();
        if(Auth::guard('admin')->user()->type=="admin"){
            $pagesModule['view_access'] = 1;
            $pagesModule['edit_access'] = 1;
            $pagesModule['full_access'] = 1;
        }
        else if($cmspagesModuleCount==0){
            $message = "This Feature is restricted for you! Please contact admin to enable this feature.";
            return redirect('admin/dashboard')->with('error',$message);
        }
        else{
            $pagesModule = adminsRole::where(['subadmin_id'=>Auth::guard('admin')->user()->id,'module'=>'cms_pages'])->first()->toArray();
        }
        
        // dd($cmsPages);
        return view('admin.pages.cms_pages')->with(compact('cmsPages','pagesModule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id=null)
    {
         if($id==""){
            $title = "Add CMS Page";
            $cmspage = new CmsPage;
            $message = "Congratulations! Page is Added Successfully.";
        }
        else{
            $title = "Edit CMS Page";
            $cmspage = CmsPage::find($id);
            $message = "Congratulations! Page is Updated Successfully.";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // dd($data);die;
            $validated=$request->validate([
                'title'=>'required',
                'url'=>'required',
                'description'=>'required',
            ]);

            $cmspage->title = $data['title'];
            $cmspage->url = $data['url'];
            $cmspage->description = $data['description'];
            $cmspage->meta_title = $data['meta_title'];
            $cmspage->meta_description = $data['meta_description'];
            $cmspage->meta_keywords = $data['meta_keywords'];
            $cmspage->status = 1;
            $cmspage->save();
            return redirect('cms_pages')->with('success',$message);

        }

        $message = "Congratulations! Page is Added Successfully";
        return view('admin.pages.add_edit_cmspage')->with(compact('title','cmspage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CmsPage $cmsPage)
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
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'page_id'=>$data['page_id']]);
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        CmsPage::where('id',$id)->delete();
        return redirect()->back()->with('success','Cms page has been deleted successfully!');
    }
}
