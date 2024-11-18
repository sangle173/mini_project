<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BoardConfigController extends Controller
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
        $board = Board::find($id);
        return view('manager.boards.board_configs.add_board_config', compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $board_config_id = BoardConfig::insertGetId([
            'board_id' => $request->board_id,
            'jira_url' => $request->jira_url,
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
            'environment' => $request->environment,
            'isSubBug' => $request->isSubBug,
            'tester_1' => $request->tester_1,
            'tester_2' => $request->tester_2,
            'tester_3' => $request->tester_3,
            'tester_4' => $request->tester_4,
            'tester_5' => $request->tester_5,
            'pass' => $request->pass,
            'fail' => $request->fail,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        Board::find($request->board_id)->update([
            'board_config_id' => $board_config_id,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Board Config Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(BoardConfig $boardConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $board = Board::find($id);
        $board_config = BoardConfig::find($board-> board_config_id);
        return view('manager.boards.board_configs.edit_board_config', compact('board_config', 'board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->board_config_id;

        BoardConfig::find($id)->update([
            'jira_url' => $request->jira_url,
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
            'environment' => $request->environment,
            'isSubBug' => $request->isSubBug,
            'tester_1' => $request->tester_1,
            'tester_2' => $request->tester_2,
            'tester_3' => $request->tester_3,
            'tester_4' => $request->tester_4,
            'tester_5' => $request->tester_5,
            'pass' => $request->pass,
            'fail' => $request->fail,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Board Config Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', BoardConfig::find($id)->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BoardConfig $boardConfig)
    {
        //
    }
}
