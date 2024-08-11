<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\TicketStatus;
use App\Http\Requests\StoreTicketStatusRequest;
use App\Http\Requests\UpdateTicketStatusRequest;
use App\Models\Type;
use App\Models\WorkingStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $board = Board::find($id);
        $ticket_statuses = TicketStatus::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.ticket_statuses.all_ticket_statuses',compact( 'board','ticket_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        return view('manager.boards.ticket_statuses.add_ticket_status',compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket_status_id = TicketStatus::insertGetId([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Type Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardticket_statuses',$request->board_id)->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $ticket_status = TicketStatus::find($id);
        $board = Board::find($ticket_status -> board_id);
        return view('manager.boards.ticket_statuses.edit_ticket_status',compact('ticket_status', 'board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        TicketStatus::find($id)->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardticket_statuses',$request->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket_status = TicketStatus::find($id);
        if (!is_null($ticket_status)) {
            $ticket_status->delete();
        }

        $notification = array(
            'message' => 'Delete Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
