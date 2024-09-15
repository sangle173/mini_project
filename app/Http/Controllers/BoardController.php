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
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use function Monolog\toArray;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dateS = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $dateT = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $boards = Board::latest()->get();
        return view('manager.boards.all_board', compact('boards', 'dateS', 'dateT'));
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
        $name_gen = hexdec(uniqid()) . '.' . $photo->getClientOriginalExtension();
        Image::make($photo)->resize(370, 246)->save('upload/board/' . $name_gen);
        $save_url = 'upload/board/' . $name_gen;

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
        $dateS = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $dateT = Carbon::today('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $board = Board::find($id);
        $tasks = Task::where('board_id', $board->id)->whereDate('created_at', Carbon::today())->latest()->get();
        $today_tasks = Task::where('board_id', $board->id)->whereDate('created_at', Carbon::today())->latest()->get();
        $board_config = BoardConfig::find(Board::find($id)->board_config_id);
        $teams = Team::where('board_id', $board->id)->latest()->get();
        $types = Type::where('board_id', $board->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id', $board->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id', $board->id)->latest()->get();
        $priorities = Priority::where('board_id', $board->id)->latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();;

        return view('manager.boards.view_board', compact('board', 'tasks', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'dateT', 'dateS', 'today_tasks'));
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


    /**
     * Remove the specified resource from storage.
     */
    public function filter(Request $request)
    {
        $dateS = $request->from_date;
        $dateT = $request->to_date;
        $dateFrom = new Carbon($request->from_date, 'Asia/Ho_Chi_Minh');
        $dateTo = new Carbon($request->to_date,'Asia/Ho_Chi_Minh');
        $dateTo -> addDays(1);
        if (!isset($request->type) || $request->type == null) {
            $allTypeId = [];
            $types = DB::table('types')->select('id')->get();
            for ($i = 0; $i < $types->count(); $i++) {
                array_push($allTypeId, $types[$i]->id);
            }  // end for

            $request['type'] = $allTypeId;
        }

        if (!isset($request->team)) {
            $allTeamId = [];
            $teams = DB::table('teams')->select('id')->get();
            for ($i = 0; $i < $teams->count(); $i++) {
                array_push($allTeamId, $teams[$i]->id);
            }  // end for

            $request['team'] = $allTeamId;
        }

        if (!isset($request->working_status)) {
            $allWkId = [];
            $working_statuses = DB::table('working_statuses')->select('id')->get();
            for ($i = 0; $i < $working_statuses->count(); $i++) {
                array_push($allWkId, $working_statuses[$i]->id);
            }  // end for

            $request['working_status'] = $allWkId;
        }
        if (!isset($request->ticket_status)) {
            $allTkId = [];
            $ticket_statuses = DB::table('ticket_statuses')->select('id')->get();
            for ($i = 0; $i < $ticket_statuses->count(); $i++) {
                array_push($allTkId, $ticket_statuses[$i]->id);
            }  // end for

            $request['ticket_status'] = $allTkId;
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
            ->where('board_id', $request->board_id)
            ->whereBetween('created_at', [$dateFrom->format('Y-m-d'), $dateTo->format('Y-m-d')])
            ->whereIn('type', $request->type)
            ->whereIn('team', $request->team)
            ->whereIn('working_status', $request->working_status)
            ->whereIn('ticket_status', $request->ticket_status)
            ->whereIn('priority', $request->priority)
            ->whereIn('tester_1', $request->user)
//            ->orWhereIn('tester_2', $request->user)
//            ->orWhereIn('tester_3', $request->user)
//            ->orWhereIn('tester_4', $request->user)
//            ->orWhereIn('tester_5', $request->user)
            ->get();
        $board = Board::find($request->board_id);
        $today_tasks = Task::where('board_id', $board->id)->whereDate('created_at', Carbon::today())->latest()->get();
        $board_config = BoardConfig::find(Board::find($request->board_id)->board_config_id);
        $teams = Team::where('board_id', $board->id)->latest()->get();
        $types = Type::where('board_id', $board->id)->latest()->get();
        $working_statuses = WorkingStatus::where('board_id', $board->id)->latest()->get();
        $ticket_statuses = TicketStatus::where('board_id', $board->id)->latest()->get();
        $priorities = Priority::where('board_id', $board->id)->latest()->get();
        $users = User::whereNotIn('role', ['admin'])->latest()->get();
        return view('manager.boards.view_board', compact('board', 'tasks', 'board_config', 'teams', 'types', 'working_statuses', 'ticket_statuses', 'priorities', 'users', 'request','dateS', 'dateT', 'today_tasks'));
    }
}
