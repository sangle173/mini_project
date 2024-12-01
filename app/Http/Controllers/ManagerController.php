<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller
{
    public function ManagerDashboard()
    {
        return view('manager.index');
    }

    // End Method

    public function ManagerLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    } // End Method


    public function ManagerLogin()
    {
        return view('manager.manager_login');
    } // End Method

    public function ManagerProfile()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('manager.manager_profile_view', compact('profileData'));
    }// End Method

    public function ShowUser($id)
    {
        $user = User::find($id);
        return view('manager.users.user_view', compact('user'));
    }

    public function ManagerProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
//        $data->name = $request->name;
//        $data->username = $request->username;
//        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/manager_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/manager_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Manager Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method


    public function ManagerChangePassword()
    {

        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('manager.manager_change_password', compact('profileData'));

    }// End Method


    public function ManagerPasswordUpdate(Request $request)
    {

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

    public function AllUser()
    {

        $allusers = User::latest()->get();
        return view('manager.users.all_user', compact('allusers'));
    }// End Method

    public function UpdateUserStatus(Request $request)
    {

        $userId = $request->input('user_id');
        $isChecked = $request->input('is_checked', 0);

        $user = User::find($userId);
        if ($user) {
            $user->status = $isChecked;
            $user->save();
        }

        return response()->json(['message' => 'User Status Updated Successfully']);

    }// End Method


    public function AddUser()
    {
        $roles = ['manager', 'user'];
        return view('manager.users.add_user', compact('roles'));
    }// End Method

    public function SaveUser(Request $request)
    {
//        dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user_id = User::insertGetId([
            'name' => $request->name,
            'username' => $request->email,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone' => $request->phone,
            'title' => $request->title,
            'address' => $request->address,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $notification = array(
            'message' => 'Create New User Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.users')->with($notification);

    }// End Method

    public function EditUser($id)
    {
        $user = User::find($id);
        $roles = ['manager', 'user'];
        return view('manager.users.edit_user', compact('user', 'roles'));
    }// End Method

    public function UpdateUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
        ]);

        $id = $request->id;

        User::find($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->email,
            'role' => $request->role,
            'phone' => $request->phone,
            'title' => $request->title,
            'address' => $request->address,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update User Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.users')->with($notification);

    }// End Method


    public function DeleteUser($id)
    {

        $user = User::find($id);
        if (!is_null($user)) {
            $user->delete();
        }

        $notification = array(
            'message' => 'Delete User Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method
}
