<?php

namespace App\Http\Controllers;

use App\Models\Course_goal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\File;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\UpdateFileRequest;
use App\Models\User;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $files = File::latest()->get();;
        return view('manager.files.all_file', compact('users', 'files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $users = User::latest()->get();
        $files = File::latest()->get();;
        return view('manager.files.upload_file', compact('users', 'files'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFileRequest $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        File::find($id)->delete();
        $notification = array(
            'message' => 'File Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function destroyAll($userId)
    {
        $files = File::where('user_id',$userId)->latest()->get();
        for ($i = 0; $i < $files; $i++) {
            File::find($files[i] -> id)->delete();
        }  // end for
        $notification = array(
            'message' => 'Deleted All Files Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function UploadFileByUserId(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        $user = User::find($request->user_id);
        $users = User::latest()->get();
        $files = File::where('user_id', $request->user_id)->orderBy('id', 'desc')->get();
        return view('manager.files.add_file', compact('user', 'users', 'files'));
    }// End Method


    public function UserStoreFile(Request $request)
    {

        $request->validate([
            'files' => 'required',
        ]);

        $files = [];
        if ($request->file('files')) {
            foreach ($request->file('files') as $key => $file) {
                $size = $file->getSize();
                $fileName = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $files[]['name'] = $fileName;
                $file_id = File::insertGetId([
                    'name' => $fileName,
                    'user_id' => $request->user_id,
                    'size' => $size,
                    'extension' => $file->getClientOriginalExtension(),
                    'file_slug' => strtolower(str_replace(' ', '-', $fileName)),
                    'share' => 0,
                    'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                ]);
            }
        }

        $notification = array(
            'message' => 'File Uploaded Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }// End Method
}
