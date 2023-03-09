<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\PutRequest;
use App\Http\Requests\Note\StoreRequest;
use App\Models\Note;

class NoteController extends Controller
{   
    public function index()
    {
        $notes = Note::where('main_user_id', auth()->user()->id)->paginate(4);
        return view('dashboard', compact('notes'));
    }

    public function create()
    {
        $note = new Note();
        return view('dashboard.note.create', compact('note'));
    }

    public function store(StoreRequest $request)
    {
        Note::create([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'main_user_id' => auth()->user()->id
        ]);
        return to_route('dashboard')->with('status', 'created');
    }

    public function show(Note $note)
    {
        return view('dashboard.note.show', compact('note'));
    }

    public function edit(Note $note)
    {
        return view('dashboard.note.edit', compact('note'));
    }

    public function update(PutRequest $request, Note $note)
    {
        $note->update([
            'title' => $request->validated('title'),
            'description' => $request->validated('description'),
            'main_user_id' => auth()->user()->id
        ]);

        return to_route('dashboard')->with('status', 'updated');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return to_route('dashboard')->with('status', 'deleted');
    }
}
