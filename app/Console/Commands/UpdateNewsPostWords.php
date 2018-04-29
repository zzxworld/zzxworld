<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NewsPost;
use Log;

class UpdateNewsPostWords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:news-post-words';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '更新新闻关键词';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        NewsPost::orderBy('id')->chunk(10, function ($posts) {
            $time = time();
            foreach ($posts as $post) {
                $post->updateWords();
            }
            Log::debug('update news keywords from '.$posts->min('id').' to '.$posts->max('id').'. ['.(time()-$time).' s]');
        });
    }
}
