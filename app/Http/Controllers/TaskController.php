<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardConfig;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Team;
use App\Models\TicketStatus;
use App\Models\Type;
use App\Models\User;
use App\Models\WorkingStatus;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $board = Board::find($id);
        $tasks = Task::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.tasks.all_task',compact( 'board','tasks'));
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
    public function store(StoreTaskRequest $request)
    {
        //
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
    public function edit(Task $task)
    {
        //
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
    public function destroy(Task $task)
    {
        //
    }
}
