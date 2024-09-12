<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\BoardConfig;
use App\Models\Priority;
use App\Models\Project;
use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = Board::latest()->get();
        return view('manager.boards.all_board',compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.boards.add_board');
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
            'title' => $request->title,
            'start_date' => $request->start_date,
            'board_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'desc' => $request->desc,
            'status' => 1,
            'photo' => $save_url,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $board_config_id = BoardConfig::insertGetId([
            'board_id' => $board_id,
            'jira_url' => "jira.com",
            'team' => 1,
            'type' => 1,
            'jira_id' => 1,
            'jira_summary' => 1,
            'working_status' => 1,
            'ticket_status' => 1,
            'link_to_result' => 1,
            'test_plan' => 1,
            'sprint' => 1,
            'note' => 1,
            'priority' => 1,
            'tester_1' => 1,
            'tester_2' => 1,
            'tester_3' => 1,
            'tester_4' => 1,
            'tester_5' => 1,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        Board::find($board_id)->update([
            'board_config_id' => $board_config_id,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Board Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $board = Board::find($id);
//        $tasks = Task::where('board_id',$board ->id)->latest()->get();
        $tasks = Task::where('board_id',$board ->id) -> whereDate('created_at', Carbon::today())->latest()->get();
        $board_config = BoardConfig::find(Board::find($id) -> board_config_id);
        $teams = Team::where('board_id',$board ->id)->latest()->get();
        $types = Type::where('board_id',$board ->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id',$board ->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id',$board ->id)->latest()->get();
        $priorities = Priority::where('board_id',$board ->id)->latest()->get();
        $users = User::whereNotIn('role',['admin']) ->latest()->get();;
        return view('manager.boards.view_board',compact('board','tasks','board_config', 'teams','types','working_statuses','ticket_statuses','priorities','users'));
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
