<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Environment;
use App\Http\Requests\StoreEnvironmentRequest;
use App\Http\Requests\UpdateEnvironmentRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $task = Task::find($id);
        return view('manager.boards.tasks.add_env', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $env_id = Environment::insertGetId([
            'task_id' => $request->task_id,
            'email' => $request->email,
            'browser' => $request->browser,
            'player' => $request->player,
            'drop_date' => $request->drop_date,
            'build' => $request->build,
            'device' => $request->device,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        Task::find($request->task_id)->update([
            'environment' => $env_id,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $board_id = Board::find(Task::find($request->task_id) -> board_id) -> id;

        $notification = array(
            'message' => 'Env Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $env = Environment::find($id);
        return view('manager.boards.tasks.env_details', compact('env'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $env= Environment::find($id);
        $task = Task::find($env -> task_id);
        return view('manager.boards.tasks.edit_env', compact('task', 'env'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Environment::find($request -> env_id)->update([
            'email' => $request->email,
            'browser' => $request->browser,
            'player' => $request->player,
            'drop_date' => $request->drop_date,
            'build' => $request->build,
            'device' => $request->device,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $board_id = Board::find(Task::find($request->task_id) -> board_id) -> id;

        $notification = array(
            'message' => 'Env Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Environment $environment)
    {
        //
    }
}
