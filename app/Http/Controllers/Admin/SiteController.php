<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Tag;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $limit = $request->input('limit', 50);
            $sites = Site::orderBy('id', 'desc')->with('tags')->paginate($limit);

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

        $tags = Tag::findOrCreateMany($request->input('tags'));
        $site = Site::create($request->all());
        $site->tags()->sync($tags->pluck('id')->toArray());

        return ['message' => 'ok'];
    }

    public function bulkDestroy(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required|array',
            'ids.*' => 'numeric',
        ]);

        foreach ($request->input('ids') as $id) {
            $site = Site::find($id);

            if ($site) {
                $site->delete();
            }
        }

        return ['message' => 'ok'];
    }
}
