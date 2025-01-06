<?php

namespace App\Http\Controllers;

use App\Exports\TasksExport;
use App\Exports\TasksWithCountExport;
use App\Imports\TaskImport;
use App\Models\Board;
use App\Models\BoardConfig;
use App\Models\Comment;
use App\Models\Environment;
use App\Models\Priority;
use App\Models\ReportConfig;
use App\Models\Task;
use App\Models\TaskHistory;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;
use Illuminate\Validation\Rule;
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
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        $dateS = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $dateT = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $end->addDays(1);
        $tasks = DB::table('tasks')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->get();
        $types = Type::latest()->get();
        $boards = Board::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $teams = Team::all()->sortBy('id');
        return view('manager.boards.tasks.all_task', compact('tasks', 'teams', 'users', 'priorities', 'types', 'dateS', 'dateT', 'boards', 'working_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $currentUser = Auth::user();
        $board = Board::find($id);
        $board_config = BoardConfig::find($board->board_config_id);
        $teams = Team::latest()->get();
        $types = $board->id == 1 ? Type::whereIn('id', [1, 2, 3])->latest()->get() : Type::whereNotIn('id', [1, 2, 3])->latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();;
        return view('manager.boards.tasks.add_task', compact('board', 'currentUser', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users'));
    }

    /**
     * Show chart the form for creating a new resource.
     */
    public function chart_show()
    {
        $tasks = Task::latest()->get();
        return view('manager.boards.chart', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Define today's date range
        $startOfDay = Carbon::today()->startOfDay();
        $endOfDay = Carbon::today()->endOfDay();

        // Validation rules
        $request->validate([
            'jira_id' => [
                'required',
                Rule::unique('tasks', 'jira_id')->where(function ($query) use ($startOfDay, $endOfDay) {
                    return $query->whereBetween('created_at', [$startOfDay, $endOfDay]);
                }),
            ],
            'type' => 'required',
            'working_status' => 'required',
            'ticket_status' => 'required',
            'jira_summary' => 'required',
            'tester_1' => 'required|not_in:0',
        ], [
//            'jira_id.unique' => 'The Jira ID has already been used in today\'s tasks. Please use a different ID.',
            'jira_id.unique' => 'The Jira ID has already been used in today\'s tasks. Đổi ID đi má',
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
            'pass' => $request->pass,
            'fail' => $request->fail,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'created_at' => $request->created_at != null ? $request->created_at : Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $task_id,
            'content' => Auth::user()->name . " created task",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Ticket Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->withInput()->with($notification);
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'review' => 'required',
        ]);

        Task::find($request->task_id)->update([
            'review' => $request->review,
            'status' => $request->status != null ? '1' : '0',
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Review Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('task.details', $request->task_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $task = Task::find($id);
        $task_histories = TaskHistory::where('task_id', $id)->latest()->get();
        $board_config = BoardConfig::find(Board::find($task->board_id)->board_config_id);
        $comments = Comment::where('task_id', $id)->latest()->get();
        return view('manager.boards.tasks.task-details', compact('task', 'comments', 'board_config', 'task_histories'));
    }

    /**
     * Display the specified resource.
     */
    public function save_comment(Request $request)
    {
        $currentUser = Auth::user();
        $comment_id = Comment::insertGetId([
            'content' => $request->contents,
            'user_id' => $currentUser->id,
            'task_id' => $request->task_id,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " added a comment",
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
        $teams = Team::latest()->get();
        $types = $board->id == 1 ? Type::whereIn('id', [1, 2, 3])->latest()->get() : Type::whereNotIn('id', [1, 2, 3])->latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        return view('manager.boards.tasks.edit_task', compact('task', 'board', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'currentUser', 'priorities'));
    }

    public function cloneTask($id)
    {
        $currentUser = Auth::user();
        $task = Task::find($id);
        $board = Board::find($task->board_id);
        $board_config = BoardConfig::find($board->board_config_id);
        $teams = Team::latest()->get();
        $types = Type::latest()->get();
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        return view('manager.boards.tasks.clone_task', compact('task', 'board', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'currentUser', 'priorities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
//        dd($request);
        $id = $request->task_id;
        $existingTask = Task::find($id);
        $validated = $request->validate([
            'type' => 'required',
            'jira_summary' => 'required',
            'tester_1' => 'required',
        ]);
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
            'pass' => $request->pass,
            'fail' => $request->fail,
            "environment" => $existingTask->environment,
            "parent_task_id" => $existingTask->parent_task_id,
            "isSubBug" => $existingTask->isSubBug,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        //        dd($request);

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " updated task",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Task Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * Update the specified resource in storage.
     */
    public function cloneTaskAction(Request $request)
    {
        $id = $request->task_id;
        $validated = $request->validate([
            'type' => 'required',
            'jira_summary' => 'required',
            'tester_1' => 'required',
        ]);
        $existingTask = Task::find($id);
        if (BoardConfig::find(Board::find($request->board_id)->board_config_id)->environment != 0) {
            $newEnv = Environment::find($existingTask->environment)->replicate();
            $newEnv->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $newEnv->save();
            $newEnvId = $newEnv->id;
        } else {
            $newEnvId = null;
        }

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
            'pass' => $request->pass,
            'fail' => $request->fail,
            "environment" => $newEnvId,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " cloned task",
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
        $board = Board::find($task->board_id);
        if (!is_null($task)) {
            $task->delete();
        }

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $id,
            'content' => Auth::user()->name . " deleted task",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Delete Task Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $board->id)->with($notification);

    }

    public function filter(Request $request)
    {
        $no = 0;
        $type = $request->type;
        $team = $request->team;
        $tester = $request->tester;
        $date = new Carbon($request->date, 'Asia/Ho_Chi_Minh');
        if ($type != null && $team == null && $tester == null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('type', $request->type)
                ->get();
            $no = 1;
        }
        if ($type == null && $team != null && $tester == null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('team', $request->team)
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type == null && $team == null && $tester != null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type != null && $team != null && $tester != null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('type', $request->type)
                ->where('team', $request->team)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 3;
        }

        if ($type != null && $team != null && $tester == null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('type', $request->type)
                ->where('team', $request->team)
                ->latest()
                ->get();
            $no = 2;
        }
        if ($type == null && $team != null && $tester != null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('team', $request->team)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 2;
        }
        if ($type != null && $team == null && $tester != null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->where('type', $request->type)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 2;
        }

        if ($type == null && $team == null && $tester == null) {
            $tasks = DB::table('tasks')
                ->whereDate('created_at', $date)
                ->where('board_id', $request->board_id)
                ->latest()
                ->get();
            $no = 0;
        }

        $types = $request->board_id == 1 ? Type::whereIn('id', [1, 2, 3])->latest()->get() : Type::whereNotIn('id', [1, 2, 3])->latest()->get();
        $boards = Board::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->orderBy('name')->get();
        $working_statuses = WorkingStatus::latest()->get();
        $board = Board::find($request->board_id);
        $teams = Team::all()->sortBy('id');
        $board_config = BoardConfig::find(Board::find($request->board_id)->board_config_id);
        $report_config = ReportConfig::where('board_id', $board->id)->first();
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $final_subject = $report_config->subject . ' ' . $days[Carbon::today('Asia/Ho_Chi_Minh')->dayOfWeek] . ', ' . Carbon::today('Asia/Ho_Chi_Minh')->isoFormat($report_config->date_format);
        $slack_subject = "Hi team, please see below for the daily report on " . $days[Carbon::today('Asia/Ho_Chi_Minh')->dayOfWeek] . ', ' . Carbon::today('Asia/Ho_Chi_Minh')->isoFormat($report_config->date_format);
        $ticket_statuses = TicketStatus::latest()->get();
        $currentUser = Auth::user();
        return view('manager.boards.view_board', compact('types', 'currentUser', 'ticket_statuses', 'boards', 'slack_subject', 'no', 'working_statuses', 'priorities', 'request', 'users', 'tasks', 'board', 'teams', 'board_config', 'final_subject', 'report_config'));
    }

    public function filter_export(Request $request)
    {
        $validated = $request->validate([
            'from_date' => 'required',
            'to_date' => 'required'
        ]);

        $no = 0;
        $type = $request->type;
        $tester = $request->tester;
        $board = $request->board;
        $flag = $request->unique_flag;
        $fromDate = new Carbon($request->from_date, 'Asia/Ho_Chi_Minh');
        $toDate = new Carbon($request->to_date, 'Asia/Ho_Chi_Minh');
        $toDate->addDays(1);
//        $subquery = Task::where('board_id', $request->board) -> select('jira_id', DB::raw('MAX(updated_at) as latest_update'))
//            ->groupBy('jira_id');
//        $tasks = Task::where('board_id', $request->board) ->whereBetween('created_at', [$fromDate, $toDate]) -> where('type', $request->type) -> joinSub($subquery, 'latest_tasks', function ($join) {
//            $join->on('tasks.jira_id', '=', 'latest_tasks.jira_id')
//                ->on('tasks.updated_at', '=', 'latest_tasks.latest_update');
//        })->get();
        if ($type != null && $board == null && $tester == null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('type', $request->type)
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type != null && $board == null && $tester == null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('type', $request->type)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type == null && $board != null && $tester == null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type == null && $board != null && $tester == null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->latest()
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->get();
            $no = 1;
        }
        if ($type == null && $board == null && $tester != null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type == null && $board == null && $tester != null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('tester_1', $request->tester)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 1;
        }
        if ($type != null && $board != null && $tester != null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('type', $request->type)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 3;
        }

        if ($type != null && $board != null && $tester != null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('type', $request->type)
                ->where('tester_1', $request->tester)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 3;
        }

        if ($type != null && $board != null && $tester == null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('type', $request->type)
                ->latest()
                ->get();
            $no = 2;
        }

        if ($type != null && $board != null && $tester == null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('type', $request->type)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 2;
        }
        if ($type == null && $board != null && $tester != null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 2;
        }
        if ($type == null && $board != null && $tester != null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('board_id', $request->board)
                ->where('tester_1', $request->tester)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 2;
        }
        if ($type != null && $board == null && $tester != null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('type', $request->type)
                ->where('tester_1', $request->tester)
                ->latest()
                ->get();
            $no = 2;
        }

        if ($type != null && $board == null && $tester != null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->where('type', $request->type)
                ->where('tester_1', $request->tester)
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 2;
        }

        if ($type == null && $board == null && $tester == null && $flag == null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->latest()
                ->get();
            $no = 0;
        }

        if ($type == null && $board == null && $tester == null && $flag != null) {
            $tasks = DB::table('tasks')
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->whereIn('id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('tasks')
                        ->groupBy('jira_id');
                })
                ->latest()
                ->get();
            $no = 0;
        }

//        $uniqueTasks = $tasks->groupBy('jira_id')->map(function ($group) {
//            return $group->sortByDesc('updated_at')->first(); // Get the latest task for each jira_id
//        });
        $types = Type::latest()->get();
        $boards = Board::latest()->get();
        $priorities = Priority::latest()->get();
        $users = User::whereNotIn('role', ['admin'])->orderBy('name')->get();
        $working_statuses = WorkingStatus::latest()->get();
        $board = Board::find($request->board);
        $teams = Team::all()->sortBy('id');
        return view('manager.boards.tasks.all_task', compact('types', 'flag', 'boards', 'no', 'working_statuses', 'priorities', 'request', 'users', 'tasks', 'board', 'teams'));
    }

    public function filter2(Request $request)
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
//        dd($request);
        $taskIdList = [];
        for ($i = 0; $i < count($tasks); $i++) {
            array_push($taskIdList, $tasks[$i]->id);
        }  // end for
        $tasks = DB::table('tasks')->whereIn('id', $taskIdList)->get();
        if ($request->flag == '1') {
            return Excel::download(new TasksWithCountExport($tasks), 'tasks_with_remove_duplicate.xlsx');
        } else {
            return Excel::download(new TasksExport($tasks), 'tasks.xlsx');
        }
    }

    public function create_sub_task($id)
    {
        $board = Board::find(Task::find($id)->board_id);
        $parent_task = Task::find($id);
        return view('manager.boards.tasks.add_sub_task', compact('parent_task', 'board'));
    }

    public function save_sub_task(Request $request)
    {
        $parent_task_id = $request->task_id;
        $validated = $request->validate([
            'jira_summary' => 'required',
            'jira_id' => 'required',
            'created_at' => 'required',
        ]);
        $sub_task_id = Task::insertGetId([
            'type' => 1,
            'board_id' => $request->board_id,
            'jira_id' => $request->jira_id,
            'parent_task_id' => $parent_task_id,
            'jira_summary' => $request->jira_summary,
            'isSubBug' => '1',
            'tester_1' => Auth::user()->id,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'created_at' => $request->created_at != null ? $request->created_at : Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " addded a sub bug",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Create Sub Task Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
    }

    public function edit_sub_task($id)
    {
        $board = Board::find(Task::find($id)->board_id);
        $task = Task::find($id);
        $parent_task = Task::find(Task::find($id)->parent_task_id);
        return view('manager.boards.tasks.edit_sub_task', compact('task', 'board', 'parent_task'));
    }

    public function update_sub_task(Request $request)
    {
        Task::find($request->sub_task_id)->update([
            'jira_id' => $request->jira_id,
            'jira_summary' => $request->jira_summary,
            'tester_1' => Auth::user()->id,
            'task_slug' => strtolower(str_replace(' ', '-', $request->jira_id)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $board_id = Board::find(Task::find($request->sub_task_id)->board_id)->id;

        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->sub_task_id,
            'content' => Auth::user()->name . " updated sub bug",
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Sub Bug Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $board_id)->with($notification);
    }


    public function sprint_report(Request $request)
    {
        $sprint = $request->sprint;
        $board = Board::find($request->board_id);
        $types = Type::latest()->get();
        $tasks = DB::table('tasks')
            ->where('board_id', $request->board_id)
            ->where('sprint', $sprint)
            ->latest()
            ->get();
        return view('manager.boards.tasks.sprint_report', compact('types', 'sprint', 'tasks', 'board'));
    }

    public function update_working_status(Request $request)
    {
//        dd($request);
        $id = $request->task_id;
        $validated = $request->validate([
            'working_status' => 'required',
        ]);
        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " updated working status from " . WorkingStatus::find(Task::find($id)->working_status)->name . " to " . WorkingStatus::find($request->working_status)->name,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        Task::find($id)->update([
            'working_status' => $request->working_status,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Working Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function update_ticket_status(Request $request)
    {
        $id = $request->task_id;
        $validated = $request->validate([
            'ticket_status' => 'required',
        ]);
        $task_history_id = TaskHistory::insertGetId([
            'task_id' => $request->task_id,
            'content' => Auth::user()->name . " updated ticket status from " . TicketStatus::find(Task::find($id)->ticket_status)->name . " to " . TicketStatus::find($request->ticket_status)->name,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        Task::find($id)->update([
            'ticket_status' => $request->ticket_status,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function import()
    {
        return view('manager.boards.tasks.import_task');
    }// End Method


    public function import_save(Request $request)
    {
//        dd($request);
        $request->validate([
            'import_file' => 'required',
        ]);

        Excel::import(new TaskImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Import Task Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

    public function filterTasks($id, Request $request)
    {
        $query = Task::query();

        // Apply filters
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->filled('team')) {
            $query->where('team', $request->input('team'));
        }

        if ($request->filled('tester')) {
            $tester = $request->input('tester');
            $query->where(function ($q) use ($tester) {
                $q->where('tester_1', $tester)
                    ->orWhere('tester_2', $tester)
                    ->orWhere('tester_3', $tester)
                    ->orWhere('tester_4', $tester)
                    ->orWhere('tester_5', $tester);
            });
        }

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('jira_id', 'like', "%$search%")
                    ->orWhere('jira_summary', 'like', "%$search%");
            });
        }

        // Filter by date or default to today
        $date = $request->input('date', Carbon::today()->toDateString());
        $query->whereDate('created_at', $date);

        $tasks = $query->get();

        $types = Type::latest()->get();
        $testers = User::whereNotIn('role', ['admin'])->orderBy('name')->get();
        $teams = Team::all()->sortBy('id');
        $board_config = BoardConfig::find(Board::find($id)->board_config_id);
        $board = Board::find($id);
        $working_statuses = WorkingStatus::latest()->get();
        $ticket_statuses = TicketStatus::latest()->get();
        $currentUser = Auth::user();
        $users = User::whereNotIn('role', ['admin'])->where('status', '1')->orderBy('name')->get();


        return view('manager.boards.tasks.filter-task', [
            'tasks' => $tasks,
            'filters' => $request->only(['type', 'team', 'tester', 'date', 'search']),
            'types' => $types,
            'teams' => $teams,
            'testers' => $testers,
            'board_config' => $board_config,
            'board' => $board,
            'ticket_statuses' => $ticket_statuses,
            'working_statuses' => $working_statuses,
            'currentUser' => $currentUser,
            'users' => $users,
        ]);
    }

}
