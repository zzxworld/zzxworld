<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    public function index()
    {
        return view('notes.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Note::class);

        $this->validate($request, [
            'content' => 'required',
        ]);

        $note = new Note;
        $note->user_id = $request->user()->id;
        $note->save();
        $note->saveText($request->input('content'));

        return [
            'message' => 'ok',
            'note' => $note,
        ];
    }

    public function update(Request $request, Note $note)
    {
        $this->authorize('update', $note);

        $note->saveText($request->input('content'));

        return [
            'message' => 'ok',
            'note' => $note,
        ];
    }
}
