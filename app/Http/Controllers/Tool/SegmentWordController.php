<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Support\SegmentWord;

class SegmentWordController extends Controller
{
    public function index()
    {
        return view('tool.segmentwords.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);

        $words = SegmentWord::dispose($request->input('text'));
        $words = SegmentWord::analyzeTermFrequency($words);

        return [
            'message' => 'ok',
            'words' => $words,
        ];
    }
}
