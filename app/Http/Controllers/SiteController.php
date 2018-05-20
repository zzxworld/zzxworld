<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Tag;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $sites = Site::with(['tags', 'detail'])
            ->where('is_private', false)
            ->orderBy('id', 'desc')->paginate(50);

        $sites->each(function ($site) {
            $site->append('title', 'icon');
        });

        return view('site.index', [
            'sites' => $sites,
        ]);
    }

    public function go(Site $site)
    {
        return view('site.go', [
            'site' => $site,
        ]);
    }

    public function tagSiteIndex(Request $request, $id)
    {
        $sites = Site::whereHas('tags', function ($query) use ($id) {
            $query->where('tag_id', intval($id));
        })->get();

        if (!$sites->count()) {
            abort(404);
        }

        $tag = Tag::find(intval($id));

        return view('site.tag_sites', [
            'tag' => $tag,
            'sites' => $sites,
        ]);
    }

}
