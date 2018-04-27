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

        $words = array_count_values($words);
        $words = array_map(function ($key, $value) {
            return [
                'text' => $key,
                'count' => $value,
            ];
        }, array_keys($words), array_values($words));

        usort($words, function ($a, $b) {
            if ($a['count'] > $b['count']) {
                return -1;
            } else if ($a['count'] == $b['count']) {
                return 0;
            } else {
                return 1;
            }
        });

        return [
            'message' => 'ok',
            'words' => $words,
        ];
    }
}
