<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class FetchNews extends Command
{
    protected $signature = 'app:migrate';
    protected $description = '迁移应用数据';

    public function handle()
    {
        $this->changeMorphName();
    }

    protected function changeMorphName()
    {
        $mapping = [
            \App\Models\Post::MORPH_NAME => 'App\Models\Post',
            \App\Models\Note::MORPH_NAME => 'App\Models\Note',
            \App\Models\NewsPost::MORPH_NAME => 'App\Models\NewsPost',
            \App\Models\Comment::MORPH_NAME => 'App\Models\Comment',
            \App\Models\LinuxCommand::MORPH_NAME => 'App\Models\LinuxCommand',
        ];

        foreach ($mapping as $name => $className) {
            DB::table('comments')->where('commentable_type', $className)->update(['commentable_type' => $name]);
            DB::table('texts')->where('textable_type', $className)->update(['textable_type' => $name]);
        }
    }
}
