<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateTeamRequest;
use App\Models\Board;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::latest()->get();
        return view('manager.boards.teams.all_team',compact( 'teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.boards.teams.add_team');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $team_id = Team::insertGetId([
            'name' => $request->name,
            'desc' => $request->desc,
            'team_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Team Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.teams')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('manager.boards.teams.edit_team',compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        Team::find($id)->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Team Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.teams',$request->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $team = Team::find($id);
        if (!is_null($team)) {
            $team->delete();
        }

        $notification = array(
            'message' => 'Delete Team Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
