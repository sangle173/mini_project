<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = Auth::user();
        $notes = Note::where('user_id', $currentUser->id)->latest()->get();
        return view('manager.notes.all_note', compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manager.notes.add_note');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Note::insert([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'content' => $request->content,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);

        $notification = array(
            'message' => 'Note Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('note.all')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $currentUser = Auth::user();
        $notes = Note::where('user_id', $currentUser->id)->latest()->get();
        if (isset($id)) {
            $note = Note::find($id);
        } else {
            $note = null;
        }
        return view('manager.notes.all_note', compact('notes', 'note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $note = Note::find($id);
        return view('manager.notes.edit_note', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $note_id = $request->id;
        $validated = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        Note::find($note_id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        $notification = array(
            'message' => 'Note Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('note.all')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Note::find($id)->delete();

        $notification = array(
            'message' => 'Note Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
