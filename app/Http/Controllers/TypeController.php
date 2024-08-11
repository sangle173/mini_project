<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Team;
use App\Models\Type;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $board = Board::find($id);
        $types = Type::where('board_id',$board ->id)->latest()->get();
        return view('manager.boards.types.all_type',compact( 'board','types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $board = Board::find($id);
        return view('manager.boards.types.add_type',compact('board'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $type_id = Type::insertGetId([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'type_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Type Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardtypes',$request->board_id)->with($notification);
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
        $type = Type::find($id);
        $board = Board::find($type -> board_id);
        return view('manager.boards.types.edit_type',compact('type', 'board'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request ->team_id;

        Type::find($id)->update([
            'name' => $request->name,
            'board_id' => $request->board_id,
            'desc' => $request->desc,
            'type_slug' => strtolower(str_replace(' ', '-', $request->name)),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Update Type Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('manager.all.boardtypes',$request->board_id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = Type::find($id);
        if (!is_null($type)) {
            $type->delete();
        }

        $notification = array(
            'message' => 'Delete Type Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
