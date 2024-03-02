<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\Admin;
use App\Models\AdminsRole;
use App\Models\Customer;
use App\Models\Review;
// for image
use Illuminate\Support\Facades\Storage;
// for current opened tab
use Session;

class adminController extends Controller
{
    
    public function index(){
        // for current opened tab
        Session::put('page','dashboard');

        return view('admin.dashboard');
    }

    public function documentation(){
        return view('admin.documentation');
    }

    public function login(Request $req){

        if($req->isMethod('post')){
            $data = $req->all();
            // print_r($data);die;

                $validated = $req->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
            
           if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){

            // remember me functionality
            if(isset($data['remember'])&&!empty($data['remember'])){
                setcookie("email",$data['email'],time()+7 * 86400);
                setcookie("password",$data['password'],time()+7 * 86400);
            }
            else{
                setcookie("email","");
                setcookie("password","");
            }

            return redirect('admin/dashboard');
           }
            else{
                return redirect()->back()->with('error','Incorrect Email or Password!');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function update_password(Request $request){
        // for current opened tab
        Session::put('page','update_password');
        
        if($request->isMethod('post')){
            $data=$request->all();
            // print_r($data);
            if(Hash::check($data['current_password'],Auth::guard('admin')->user()->password)){
                // echo "fine ";
                if($data['new_password']==$data['confirm_password']){
                    // return "password is maching";
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success','Password has been updated successfully!');
                }
                else{
                    return redirect()->back()->with('error','Your new password and confirm password is not matching!.');
                }
            }
            else{
                return redirect()->back()->with('error','Your current password is incorrect!');
            }
        }
        return view('admin.update_password');
    }

   public function check_password(Request $req){
        $data = $req->all();
        if(Hash::check($data['currentPassword'], Auth::guard('admin')->user()->password)){
            return "true";
        } else {
            return "false";
        }
    }

    public function admin_details(Request $request){
        // for current opened tab
        Session::put('page','update_details');

        if($request->isMethod('post')){
            $data = $request->all();

            $validated = $request->validate([
                'name' => 'required|max:255',
                'mobile' => 'required|numeric',
                'image' => 'image',
            ]);

            $imagePath = ""; 

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagePath = $image->store('public/admin/images');
                $imageUrl = Storage::url($imagePath);
            }
            elseif(!empty($data['current_image'])){
                $imagePath = $data['current_image'];
            }
            else{
                $image = "";
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'image' => basename($imagePath),
            ]);

            return redirect()->back()->with('success', 'Updated Successfully!');
        }

        return view('admin.admin_details');
    }

    public function subadmin(){
        Session::put('page','subadmins');
        $subadmins = Admin::where('type','subadmin')->get();
        // print_r($subadmins);die;
        return view('admin/subadmins/subadmins')->with(compact('subadmins'));
    }

    public function AddUpdateSubAdmin(Request $request,$id=null){
        if($id==""){
            $title = "Add Subadmin";
            $subadmin = new Admin;
            $message = "Congratulation! Subadmin added successfully!";
        }
        else{
            $title = "Edit Subadmin";
            $subadmin = Admin::find($id);
            $message = "Congratulation! Subadmin has been edited successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);die;
            $validated = $request->validate([
                'name'=>'required',
                'email' => 'required|email',
                'password'=>'required',
                'type'=>'required',
                'mobile'=>'required',
            ]);

            $subadmin->name = $data['name'];
            $subadmin->email = $data['email'];
            $subadmin->mobile = $data['mobile'];
            $subadmin->type = $data['type'];
            $subadmin->password = bcrypt($data['password']);
            $subadmin->image = "";
            $subadmin->status = 1;
            $subadmin->save();
            return redirect('/admin/subadmin')->with('success',$message);

        }
        return view('admin.subadmins.add_subadmin')->with(compact('title','subadmin'));
    }

     public function updateSubadminStatus(Request $request)
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
            Admin::where('id', $data['subadmin_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'subadmin_id'=>$data['subadmin_id']]);
       }
    }

     public function destroySubadmin($id)
    {
        Admin::where('id',$id)->delete();
        return redirect()->back()->with('success','Subadmin has been deleted successfully!');
    }
    
    public function updateRole($id,Request $req){
        if($req->isMethod('post')){
            $data = $req->all();
            // print_r($data);die;

            // delete all previous role 
            AdminsRole::where('subadmin_id',$id)->delete();
            // add new now dynamically
            foreach($data as $key => $value){
                if(isset($value['view'])){
                    $view = $value['view'];
                }
                else{
                    $view = 0;
                }
                if(isset($value['edit'])){
                    $edit = $value['edit'];
                }
                else{
                    $edit = 0;
                }
                if(isset($value['full'])){
                    $full = $value['full'];
                }
                else{
                    $full = 0;
                }
            }

            $role = new AdminsRole;
            $role->subadmin_id = $id;
            $role->module = $key;
            $role->view_access = $view;
            $role->edit_access = $edit;
            $role->full_access = $full;
            $role->save();

            return redirect()->back()->with('success','Congratulations! Roles and permissions are added successfully.');
        }

        $subadminRoles = AdminsRole::where('subadmin_id',$id)->get()->toArray();
        $subadminDetails = Admin::where('id',$id)->first()->toArray();
        $title = "Update " .$subadminDetails['name'] . " Subadmin Role/Permission";

        return view('admin.subadmins.update_roles')->with(compact('title','id','subadminRoles'));
    }


    public function customers(){
        Session::put('page','customers');
        $customers = Customer::all();
        // print_r($subadmins);die;
        return view('admin.customers')->with(compact('customers'));
    }

    public function AddUpdateCustomer(Request $request,$id=null){
        if($id==""){
            $title = "Add Customer";
            $customer = new Customer;
            $message = "Congratulation! Customer added successfully!";
        }
        else{
            $title = "Edit Customer";
            $customer = Customer::find($id);
            $message = "Congratulation! Customer has been edited successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);die;
            $validated = $request->validate([
                'first_name'=>'required',
                'last_name'=>'required',
                'email' => 'required|email|unique:customers,email',
                'password'=>'required',
                'phone'=>'required',
            ]);

            $customer->first_name = $data['first_name'];
            $customer->last_name = $data['last_name'];
            $customer->email = $data['email'];
            $customer->password = bcrypt($data['password']);
            $customer->phone = $data['phone'];
            $customer->status = 1;
           
            $customer->save();
            return redirect('/admin/customers')->with('success',$message);

        }
        return view('admin.add_customers')->with(compact('title','customer'));
    }

    function CustomerStatus(Request $request)
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
            Customer::where('id', $data['customer_id'])->update(['status' => $status]);
            return response()->json(['status'=>$status,'customer_id'=>$data['customer_id']]);
       }
    }

     public function destroy($id)
    {
        Customer::where('id',$id)->delete();
        return redirect()->back()->with('success','Customer has been deleted successfully!');
    }

    public function show_reviews(){
        Session::put('page','reviews');
        $reviews = Review::all();
        return view('admin.reviews')->with(compact('reviews'));
    }

    public function destroyReview($id)
    {
        Review::where('id',$id)->delete();
        return redirect()->back()->with('success','Review has been deleted successfully!');
    }
}
