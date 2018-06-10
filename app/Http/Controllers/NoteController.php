<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Support\ListContainer;

class NoteController extends Controller
{
    /**
     * 笔记本
     */
    public function notebook()
    {
        return view('notes.notebook');
    }

    /**
     * 笔记列表
     */
    public function index(Request $request)
    {
        $this->authorize('index', Note::class);
        $limit = (int) $request->input('limit', 10);

        $notes = Note::with('texts')
            ->where('user_id', $request->user()->id)
            ->orderBy('updated_at', 'desc')
            ->paginate($limit);

        $notes = new ListContainer($notes, function ($note) {
            return [
                'id' => $note->id,
                'content' => $note->text,
                'created_at' => $note->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $note->updated_at->format('Y-m-d H:i:s'),
            ];
        }, 'notes');

        return $notes->toArray(['message' => 'ok']);
    }

    /**
     * 创建笔记
     */
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

    /**
     * 更新笔记
     */
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
