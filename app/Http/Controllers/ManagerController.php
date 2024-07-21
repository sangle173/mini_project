<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function ManagerDashboard(){
        return view('manager.index');
    }
    // End Method

    public function ManagerLogout(Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/manager/login');
    } // End Method


    public function ManagerLogin(){
        return view('manager.manager_login');
    } // End Method

    public function ManagerProfile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('manager.manager_profile_view',compact('profileData'));
    }// End Method


    public function ManagerProfileStore(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
           $file = $request->file('photo');
           @unlink(public_path('upload/manager_images/'.$data->photo));
           $filename = date('YmdHi').$file->getClientOriginalName();
           $file->move(public_path('upload/manager_images'),$filename);
           $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Manager Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function ManagerChangePassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('manager.manager_change_password',compact('profileData'));

    }// End Method


    public function ManagerPasswordUpdate(Request $request){

        /// Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth::user()->password)) {

            $notification = array(
                'message' => 'Old Password Does not Match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }

        /// Update The new Password
        User::whereId(auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );
        return back()->with($notification);

    }// End Method




}
