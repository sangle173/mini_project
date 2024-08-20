<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Priority;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $board = Board::find($id);
        $priorities = Priority::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.priorities.all_priorities',compact( 'board','priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        return view('manager.boards.priorities.add_priority',compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $priority_id = Priority::insertGetId([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'priority_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Create Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardpriorities',$request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $priority = Priority::find($id);
        $board = Board::find($priority-> board_id);
        return view('manager.boards.priorities.edit_priority',compact('priority', 'board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        Priority::find($id)->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'priority_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardpriorities',$request->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $priority = Priority::find($id);
        if (!is_null($priority)) {
            $priority->delete();
        }

        $notification = array(
            'message' => 'Delete Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
