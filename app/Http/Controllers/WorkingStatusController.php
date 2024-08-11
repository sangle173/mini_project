<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Type;
use App\Models\WorkingStatus;
use App\Http\Requests\StoreWorkingStatusRequest;
use App\Http\Requests\UpdateWorkingStatusRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class WorkingStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $board = Board::find($id);
        $working_statuses = WorkingStatus::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.working_statuses.all_working_statuses',compact( 'board','working_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        return view('manager.boards.working_statuses.add_working_status',compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $working_status_id = WorkingStatus::insertGetId([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'working_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Type Working Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardworking_statuses',$request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $working_status = WorkingStatus::find($id);
        $board = Board::find($working_status -> board_id);
        return view('manager.boards.working_statuses.edit_working_status',compact('working_status', 'board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        WorkingStatus::find($id)->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'working_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Working Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardworking_statuses',$request->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $working_status = WorkingStatus::find($id);
        if (!is_null($working_status)) {
            $working_status->delete();
        }

        $notification = array(
            'message' => 'Delete Working Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
