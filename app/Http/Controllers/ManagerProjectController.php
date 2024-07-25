<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use function Termwind\ValueObjects\pr;

class ManagerProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();
        return view('manager.projects.all_project',compact('projects'));
    }

//    /**
//     * Show the form for creating a new resource.
//     */
//    public function create()
//    {
//        //
//        return view('admin.backend.projects.add_project');
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     */
//    public function store(Request $request)
//    {
//        $photo = $request->file('photo');
//        $name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
//        Image::make($photo)->resize(370,246)->save('upload/projects/thambnail/'.$name_gen);
//        $save_url = 'upload/projects/thambnail/'.$name_gen;
//
//        $project_id = Project::insertGetId([
//            'name' => $request->name,
//            'title' => $request->title,
//            'start_date' => $request->start_date,
//            'project_slug' => strtolower(str_replace(' ', '-', $request->name)),
//            'desc' => $request->desc,
//            'status' => 1,
//            'photo' => $save_url,
//            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//        ]);
//
//        $notification = array(
//            'message' => 'Project Created Successfully',
//            'alert-type' => 'success'
//        );
//        return redirect()->route('admin.all.projects')->with($notification);
//    }
//
//    /**
//     * Display the specified resource.
//     */
//    public function show(Project $project)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     */
//    public function edit($id)
//    {
//        $project = Project::find($id);
//        return view('admin.backend.projects.edit_project',compact('project'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     */
//    public function update(Request $request)
//    {
//        $id = $request ->project_id;
//
//        Project::find($id)->update([
//            'name' => $request -> name,
//            'title' => $request-> title,
//            'start_date' => $request-> start_date,
//            'desc' => $request-> desc,
//            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
//        ]);
//
//        $notification = array(
//            'message' => 'Update Project Successfully',
//            'alert-type' => 'success'
//        );
//        return redirect()->route('admin.all.projects')->with($notification);
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy($id)
//    {
//        $project = Project::find($id);
//        if (!is_null($project)) {
//            $project->delete();
//        }
//
//        $notification = array(
//            'message' => 'Delete Project Successfully',
//            'alert-type' => 'success'
//        );
//        return redirect()->back()->with($notification);
//    }
//
//    public function UpdateProjectStatus(Request $request){
//        $projectId = $request->input('project_id');
//        $isChecked = $request->input('is_checked',0);
//
//        $project = Project::find($projectId);
//        if ($project) {
//            $project->status = $isChecked;
//            $project->save();
//        }
//
//        return response()->json(['message' => 'Project Status Updated Successfully']);
//
//    }// End Method
}
