<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Board;
use App\Models\BoardConfig;
use App\Models\Comment;
use App\Models\Priority;
use App\Models\Task;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $currentUser = Auth::user();
        $board = Board::find($id);
        $board_config = BoardConfig::find(Board::find($id)->board_config_id);
        $tasks = Task::where('board_id', $board->id)->latest()->get();
        return view('manager.boards.tasks.all_task_by_board', compact('board', 'tasks', 'board_config'));
    }

    /**
     * Display a listing of the resource.
     */
    public function all_task()
    {
        $dateS = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $dateT = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $types = Type::latest()->get();
        $boards = Board::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $tasks = Task::latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        return view('manager.boards.tasks.all_task', compact('tasks', 'users', 'priorities', 'types', 'dateS', 'dateT', 'boards', 'working_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        $board_config = BoardConfig::find($board->board_config_id);
        $teams = Team::where('board_id', $board->id)->latest()->get();
        $types = Type::where('board_id', $board->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id', $board->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id', $board->id)->latest()->get();
        $priorities = Priority::where('board_id', $board->id)->latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();;
        return view('manager.boards.tasks.add_task', compact('board', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tester_1' => 'required',
        ]);
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
            'priority' => $request->priority,
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
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $task = Task::find($id);
        $board_config = BoardConfig::find(Board::find($task -> board_id)->board_config_id);
        $comments =  Comment::where('task_id', $id)->latest()->get();
        return view('manager.boards.tasks.task-details', compact('task', 'comments', 'board_config'));
    }

    /**
     * Display the specified resource.
     */
    public function save_comment(Request $request)
    {
        $currentUser = Auth::user();
        $comment_id = Comment::insertGetId([
            'content' => $request-> contents,
            'user_id' => $currentUser -> id,
            'task_id' => $request->task_id,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $notification = array(
            'message' => 'Comment Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('task.details', $request->task_id)->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $currentUser = Auth::user();
        $task = Task::find($id);
        $board = Board::find($task->board_id);
        $board_config = BoardConfig::find($board->board_config_id);
        $teams = Team::where('board_id', $board->id)->latest()->get();
        $types = Type::where('board_id', $board->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id', $board->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id', $board->id)->latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $priorities = Priority::where('board_id', $board->id)->latest()->get();
        return view('manager.boards.tasks.edit_task', compact('task', 'board', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'currentUser'));
    }

    public function cloneTask($id)
    {
        $currentUser = Auth::user();
        $task = Task::find($id);
        $board = Board::find($task->board_id);
        $board_config = BoardConfig::find($board->board_config_id);
        $teams = Team::where('board_id', $board->id)->latest()->get();
        $types = Type::where('board_id', $board->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id', $board->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id', $board->id)->latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $priorities = Priority::where('board_id', $board->id)->latest()->get();
        return view('manager.boards.tasks.clone_task', compact('task', 'board', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'currentUser'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->task_id;

        Task::find($id)->update([
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
            'priority' => $request->priority,
            'tester_1' => $request->tester_1,
            'tester_2' => $request->tester_2,
            'tester_3' => $request->tester_3,
            'tester_4' => $request->tester_4,
            'tester_5' => $request->tester_5,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Task Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function cloneTaskAction(Request $request)
    {
        $id = $request->task_id;

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
            'priority' => $request->priority,
            'tester_1' => $request->tester_1,
            'tester_2' => $request->tester_2,
            'tester_3' => $request->tester_3,
            'tester_4' => $request->tester_4,
            'tester_5' => $request->tester_5,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
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

    public function filter(Request $request)
    {
        $dateS = $request->from_date;
        $dateT = $request->to_date;
        $dateFrom = new Carbon($request->from_date, 'Asia/Ho_Chi_Minh');
        $dateTo = new Carbon($request->to_date, 'Asia/Ho_Chi_Minh');
        $dateTo->addDays(1);
        if (!isset($request->type) || $request->type == null) {
            $allTypeId = [];
            $types = DB::table('types')->select('id')->get();
            for ($i = 0; $i < $types->count(); $i++) {
                array_push($allTypeId, $types[$i]->id);
            }  // end for

            $request['type'] = $allTypeId;
        }

        if (!isset($request->board) || $request->board == null) {
            $allBoardID = [];
            $boards = DB::table('boards')->select('id')->get();
            for ($i = 0; $i < $boards->count(); $i++) {
                array_push($allBoardID, $boards[$i]->id);
            }  // end for

            $request['board'] = $allBoardID;
        }
        if (!isset($request->working_status)) {
            $allWkId = [];
            $working_statuses = DB::table('working_statuses')->select('id')->get();
            for ($i = 0; $i < $working_statuses->count(); $i++) {
                array_push($allWkId, $working_statuses[$i]->id);
            }  // end for

            $request['working_status'] = $allWkId;
        }
        if (!isset($request->priority)) {
            $allPriorityId = [];
            $priorities = DB::table('priorities')->select('id')->get();
            for ($i = 0; $i < $priorities->count(); $i++) {
                array_push($allPriorityId, $priorities[$i]->id);
            }  // end for

            $request['priority'] = $allPriorityId;
        }

        if (!isset($request->user)) {
            $allUserId = [];
            $users = DB::table('users')->select('id')->get();
            for ($i = 0; $i < $users->count(); $i++) {
                array_push($allUserId, $users[$i]->id);
            }  // end for

            $request['user'] = $allUserId;
        }


        $tasks = DB::table('tasks')
            ->whereBetween('created_at', [$dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d')])
            ->whereIn('type', $request->type)
            ->whereIn('board_id', $request->board)
            ->whereIn('working_status', $request->working_status)
            ->whereIn('priority', $request->priority)
            ->whereIn('tester_1', $request->user)
//            ->orWhereIn('tester_2', $request->user)
//            ->orWhereIn('tester_3', $request->user)
//            ->orWhereIn('tester_4', $request->user)
//            ->orWhereIn('tester_5', $request->user)
            ->get();
//        dd($tasks);

        $types = Type::latest()->get();
        $boards = Board::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        return view('manager.boards.tasks.all_task', compact('types', 'boards', 'working_statuses', 'priorities', 'users', 'request', 'dateS', 'dateT', 'tasks'));
    }

    public function exportToHtml(Request $request)
    {
        $tasks = json_decode($request->tasks);
        $taskIdList = [];
        for ($i = 0; $i < count($tasks); $i++) {
            array_push($taskIdList, $tasks[$i]->id);
        }  // end for
        $tasks = DB::table('tasks')->whereIn('id', $taskIdList)->get();
        return Excel::download(new TasksExport($tasks), 'tasks.html', \Maatwebsite\Excel\Excel::HTML);
    }

    public function exportToPdf(Request $request)
    {
        $tasks = json_decode($request->tasks);
        $taskIdList = [];
        for ($i = 0; $i < count($tasks); $i++) {
            array_push($taskIdList, $tasks[$i]->id);
        }  // end for
        $tasks = DB::table('tasks')->whereIn('id', $taskIdList)->get();
        return Excel::download(new TasksExport($tasks), 'tasks.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    public function export(Request $request)
    {
        $tasks = json_decode($request->tasks);
        $taskIdList = [];
        for ($i = 0; $i < count($tasks); $i++) {
            array_push($taskIdList, $tasks[$i]->id);
        }  // end for
        $tasks = DB::table('tasks')->whereIn('id', $taskIdList)->get();
        return Excel::download(new TasksExport($tasks), 'tasks.xlsx');
    }
}
