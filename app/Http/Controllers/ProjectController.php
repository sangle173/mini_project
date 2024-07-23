<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->get();

        return view('admin.backend.projects.all_project',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.backend.projects.add_project');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photo = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(370,246)->save('upload/project/thambnail/'.$name_gen);
        $save_url = 'upload/project/thambnail/'.$name_gen;

        $project_id = Project::insertGetId([
            'name' => $request->name,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'project_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'desc' => $request->desc,
            'status' => 1,
            'photo' => $save_url,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Project Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.project')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function UpdateProjectStatus(Request $request){
        $projectId = $request->input('project_id');
        $isChecked = $request->input('is_checked',0);

        $project = Project::find($projectId);
        if ($project) {
            $project->status = $isChecked;
            $project->save();
        }

        return response()->json(['message' => 'Project Status Updated Successfully']);

    }// End Method
}
