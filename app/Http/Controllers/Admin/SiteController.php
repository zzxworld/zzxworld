<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site;
use App\Models\Tag;
use App\Jobs\FetchSiteDetail;

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

        try {
            $tags = Tag::findOrCreateMany($request->input('tags'));
            $site = new Site($request->all());
            $site->url = $request->input('url');
            $site->save();
            $site->tags()->sync($tags->pluck('id')->toArray());
        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }

        return ['message' => 'ok', 'site' => $site];
    }

    public function update(Request $request, Site $site)
    {
        $this->validate($request, [
            'url' => 'url',
            'tags' => 'array',
        ]);

        try {
            $site->fill($request->all());

            $url = $request->input('url');
            if ($url) {
                $site->url = $request->input('url');
            }

            $site->save();

            $tags = $request->input('tags');
            if ($tags !== null) {
                $tags = Tag::findOrCreateMany($request->input('tags'));
                $site->tags()->sync($tags->pluck('id')->toArray());
            }

        } catch (\Exception $e) {
            return ['message' => $e->getMessage()];
        }

        return ['message' => 'ok', 'site' => $site];
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

    public function bulkUpdateDetail(Request $request)
    {
        $this->validate($request, [
            'ids' => 'required|array',
            'ids.*' => 'numeric',
        ]);

        foreach ($request->input('ids') as $id) {
            FetchSiteDetail::dispatch($id);
        }

        return ['message' => 'ok'];
    }
}
