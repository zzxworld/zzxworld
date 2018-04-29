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
            '01' => 'App\Models\Post',
            '02' => 'App\Models\Note',
            '03' => 'App\Models\NewsPost',
            '04' => 'App\Models\Comment',
            '05' => 'App\Models\LinuxCommand',
        ];

        foreach ($mapping as $name => $className) {
            DB::table('comments')->where('commentable_type', $className)->update(['commentable_type' => $name]);
            DB::table('texts')->where('textable_type', $className)->update(['textable_type' => $name]);
        }
    }
}
