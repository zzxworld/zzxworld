<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $sites = Site::orderBy('id', 'desc')->paginate(50);

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
}
