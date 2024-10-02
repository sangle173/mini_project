<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Priority;
use App\Models\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PriorityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $priorities = Priority::latest()->get();
        return view('manager.boards.priorities.all_priorities',compact( 'priorities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.boards.priorities.add_priority');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $priority_id = Priority::insertGetId([
            'name' => $request->name,
            'desc' => $request->desc,
            'priority_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Create Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.priorities')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Priority $priority)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $priority = Priority::find($id);
        return view('manager.boards.priorities.edit_priority',compact('priority'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        Priority::find($id)->update([
            'name' => $request->name,
            'desc' => $request->desc,
            'priority_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.priorities')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $priority = Priority::find($id);
        if (!is_null($priority)) {
            $priority->delete();
        }

        $notification = array(
            'message' => 'Delete Priority Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
