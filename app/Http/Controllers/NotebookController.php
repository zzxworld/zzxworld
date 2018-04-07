<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotebookController extends Controller
{
    public function index()
    {
        return view('notebooks.index');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Note::class);

        $this->validate($request, [
            'notes' => 'required|array',
        ]);

        $user = $request->user();
        $notes = (array) $request->input('notes');

        foreach ($notes as $rs) {
            $content = array_get($rs, 'content');
            if (!$content) {
                continue;
            }

            $id = (int) array_get($rs, 'id');
            if ($id) {
                $note = Note::where('id', $id)->where('user_id', $user->id)->first();
                if (!$note) {
                    $id = 0;
                }
            }

            if (!$id) {
                $note = new Note;
                $note->user_id = $user->id;
                $note->created_at = array_get($rs, 'created_at');
                $note->updated_at = array_get($rs, 'updated_at');
                $note->save();
            }

            $note->saveText($content);
        }

        return ['message' => 'ok'];
    }
}
