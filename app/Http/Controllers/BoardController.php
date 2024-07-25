<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Project;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $project = Project::find($id);
        $boards = Board::where('project_id',$project ->id)->latest()->get();
        return view('manager.boards.all_board',compact('boards', 'project'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $project = Project::find($id);
        return view('manager.boards.add_board',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $photo = $request->file('photo');
        $name_gen = hexdec(uniqid()).'.'.$photo->getClientOriginalExtension();
        Image::make($photo)->resize(370,246)->save('upload/board/'.$name_gen);
        $save_url = 'upload/board/'.$name_gen;

        $board_id = Board::insertGetId([
            'name' => $request->name,
            'project_id' => $request->project_id,
            'title' => $request->title,
            'start_date' => $request->start_date,
            'board_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'desc' => $request->desc,
            'status' => 1,
            'photo' => $save_url,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Board Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boards',$request->project_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Board $board)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Board $board)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBoardRequest $request, Board $board)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Board $board)
    {
        //
    }
}
