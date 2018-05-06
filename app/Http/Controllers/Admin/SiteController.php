<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $limit = $request->input('limit', 50);
            $sites = Site::orderBy('id', 'desc')->paginate($limit);

            return [
                'message' => 'ok',
                'sites' => $sites->items(),
            ];
        } else {
            return view('site.admin.index');
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
            'tags' => 'array',
        ]);

        if (Site::isExist($request->input('url'))) {
            return ['message' => '站点已存在'];
        }

        Site::create($request->all());

        return ['message' => 'ok'];
    }

    public function bulkDestroy(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required|array',
            'ids.*' => 'numeric',
        ]);

        Site::whereIn('id', $request->input('ids'))->delete();

        return ['message' => 'ok'];
    }
}