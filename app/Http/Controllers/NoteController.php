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
        $this->validate($request, [
            'content' => 'required',
        ]);

        $note = new Note;
        $note->user_id = 0;
        $note->save();
        $note->saveText($request->input('content'));

        return ['message' => 'ok'];
    }
}
