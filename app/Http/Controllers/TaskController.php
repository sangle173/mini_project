<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTaskRequest;
use App\Models\Board;
use App\Models\BoardConfig;
use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $currentUser = Auth::user();
        $board = Board::find($id);
        $board_config = BoardConfig::find(Board::find($id) -> board_config_id);
        $tasks = Task::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.tasks.all_task',compact( 'board','tasks', 'board_config'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        $board_config = BoardConfig::find($board-> board_config_id);
        $teams = Team::where('board_id',$board ->id)->latest()->get();
        $types = Type::where('board_id',$board ->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id',$board ->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id',$board ->id)->latest()->get();
        $users = User::where('role','user') ->latest()->get();;
        return view('manager.boards.tasks.add_task',compact('board','board_config', 'teams','types','working_statuses','ticket_statuses','users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $task_id = Task::insertGetId([
            'board_id' => $request->board_id,
            'team' => $request->team,
            'type' => $request->type,
            'jira_id' => $request->jira_id,
            'jira_summary' => $request->jira_summary,
            'working_status' => $request->working_status,
            'ticket_status' => $request->ticket_status,
            'link_to_result' => $request->link_to_result,
            'test_plan' => $request->test_plan,
            'sprint' => $request->sprint,
            'note' => $request->note,
            'tester_1' => $request->tester_1,
            'tester_2' => $request->tester_2,
            'tester_3' => $request->tester_3,
            'tester_4' => $request->tester_4,
            'tester_5' => $request->tester_5,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Ticket Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.tasks',$request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $currentUser = Auth::user();
        $task = Task::find($id);
        $board = Board::find($task -> board_id);
        $board_config = BoardConfig::find($board-> board_config_id);
        $teams = Team::where('board_id',$board ->id)->latest()->get();
        $types = Type::where('board_id',$board ->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id',$board ->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id',$board ->id)->latest()->get();
        $users = User::where('role','user') ->latest()->get();
        return view('manager.boards.tasks.edit_task',compact('task', 'board', 'board_config','teams', 'types','working_statuses','ticket_statuses','users','currentUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if (!is_null($task)) {
            $task->delete();
        }

        $notification = array(
            'message' => 'Delete Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
