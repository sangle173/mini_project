<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardConfig;
use App\Models\ReportConfig;
use App\Http\Requests\StoreReportConfigRequest;
use App\Http\Requests\UpdateReportConfigRequest;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class ReportConfigController extends Controller
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
        $report_config = ReportConfig::where('board_id', $board->id) ->get();
        return view('manager.boards.board_configs.add_report_config', compact('board', 'report_config'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $report_config = ReportConfig::where('board_id', $request->board_id) ->first();
        ReportConfig::find($report_config -> id)->update([
            'board_id' => $request->board_id,
            'subject' => $request->subject,
            'cc' => $request->cc,
            'date_format' => $request->date_format,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Report Config Saved Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.show.board', $request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportConfig $reportConfig)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportConfig $reportConfig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReportConfigRequest $request, ReportConfig $reportConfig)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportConfig $reportConfig)
    {
        //
    }
}
