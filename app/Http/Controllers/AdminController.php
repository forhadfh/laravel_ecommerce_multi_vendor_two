<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function AdminDashbord(){
        return view('admin.index');

    }//end AdminDashbord

    public function AdminLogin(){
        return view('admin.admin_login');
    }//end AdminLogin

    public function AdminDestroy(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }//end AdminDestroy

    public function AdminProfile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }//end AdminProfile

    public function AdminProfileStore(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin Profile Upload Successfully',
             'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }//end AdminProfileStore

    public function AdminChangePassword(){
        return view('admin.admin_change_password');
    }//end AdminChangePassword

    public function AdminUpdatePassword(Request $request){
        //validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // match the old password
        if (!Hash::check($request->old_password, auth::user()->password)){
            return back()->with("error", "Old Password Doesn't Match!!");
        }

        //update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully");

    }//End Method

    // ****************************************************************

    public function InactiveVendor(){
        $inActivevendor = User::where('status', 'inactive')->where('role','vendor')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inActivevendor'));
    }//End Method

    public function ActiveVendor(){
        $Activevendor = User::where('status', 'active')->where('role','vendor')->latest()->get();
        return view('backend.vendor.active_vendor',compact('Activevendor'));
    }//End Method

    public function InactiveVendorDetails($id){

        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));

    }// End Mehtod

    public function ActiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);
        $notification = array(
            'message' => ' Vendor Update  Successfully',
             'alert-type' => 'success',
        );
        return redirect()->route('active.vendor')->with($notification);

    }

    public function ActiveVendorDetails($id){

        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));

    }// End Mehtod
    public function InactiveVendorApprove(Request $request){
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);
        $notification = array(
            'message' => ' Vendor Update  Successfully',
             'alert-type' => 'success',
        );
        return redirect()->route('inactive.vendor')->with($notification);

    }


    ///admin all methods----------------------------------------------------------------

    public function AllAdmin(){
        $alladminuser = User::where('role','admin')->latest()->get();
        return view('backend.admin.all_admin',compact('alladminuser'));
    }//end method

    public function AddAdmin(){
        $roles = Role::all();
        return view('backend.admin.add_admin',compact('roles'));
    }//end method

    public function AdminUserStore(Request $request){
        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'New Admin User Inserted Successfully',
             'alert-type' => 'success',
        );
        return redirect()->route('all.admin')->with($notification);

    }//end method

    public function EditAdminRoles($id){
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('backend.admin.edit_admin',compact('user', 'roles'));
    }//end method

    public function AdminUserUpdate(Request $request,$id){


        $user = User::findOrFail($id);
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->role = 'admin';
        $user->status = 'active';
        $user->save();

        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
         $notification = array(
            'message' => 'New Admin User Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.admin')->with($notification);
    }// End Mehtod

    public function DeleteAdminRole($id){

        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
         $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Mehtod

}