<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\TicketStatus;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TicketStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ticket_statuses = TicketStatus::latest()->get();
        return view('manager.boards.ticket_statuses.all_ticket_statuses',compact( 'ticket_statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.boards.ticket_statuses.add_ticket_status');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ticket_status_id = TicketStatus::insertGetId([
            'name' => $request->name,
            'desc' => $request->desc,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Type Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.ticket_statuses')->with($notification);
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
        return view('manager.boards.ticket_statuses.edit_ticket_status',compact('ticket_status'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        TicketStatus::find($id)->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'ticket_status_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Ticket Status Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.ticket_statuses')->with($notification);
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
