<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tip;

class TipController extends Controller
{

    /**
     * 技巧列表
     */
    public function index()
    {
        $tips = Tip::orderBy('updated_at', 'desc')->get();
        return view('tips.index', ['tips' => $tips]);
    }

    /**
     * 分享技巧
     */
    public function create(Request $request)
    {
        $this->authorize('create', Tip::class);
        return view('tips.create');
    }

    /**
     * 保存新技巧
     */
    public function store(Request $request)
    {
        $this->authorize('create', Tip::class);
        $this->validate($request, [
            'content' => 'required|min:32'
        ], [
            'content.required' => '还没有填写任何技巧内容呢。',
            'content.min' => '技巧内容太短了，至少要有 32 个字吧。',
        ]);

        $tip = new Tip;
        $tip->save();
        $tip->saveText($request->input('content'));

        return redirect()->route('tips.index');
    }

}
