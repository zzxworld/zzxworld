<?php

namespace App\Console\Commands\News;

use Illuminate\Console\Command;
use App\Models\NewsFeed;

class Fetch extends Command
{
    protected $signature = 'news:fetch {--id=}';
    protected $description = '抓取新闻';

    public function handle()
    {
        $id = (int) $this->option('id');

        if ($id) {
            $feeds = NewsFeed::where('id', $id)->get();
        } else {
            $feeds = NewsFeed::all();
        }

        foreach ($feeds as $feed) {
            try {
                $feed->fetchAndSave();
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
