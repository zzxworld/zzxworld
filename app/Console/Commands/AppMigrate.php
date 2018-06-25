<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\LinuxCommand;
use App\Models\NewsPost;
use DB;

class AppMigrate extends Command
{
    protected $signature = 'app:migrate';
    protected $description = '迁移应用数据';

    public function handle()
    {
        DB::table('articles')->truncate();

        $this->exportBlogs();
        $this->exportLinuxCommands();
        $this->exportNews();
    }

    protected function exportBlogs()
    {
        Post::chunk(100, function ($items) {
            foreach ($items as $rs) {
                $data = [
                    'type' => 'blog',
                    'original_id' => $rs->id,
                    'title' => $rs->title,
                    'url' => sprintf('posts/%s', $rs->id),
                    'attributes' => json_encode([
                        'slug' => $rs->slug,
                        'source_url' => $rs->source_url,
                    ]),
                    'content' => $rs->text,
                    'created_at' => $rs->published_at,
                    'updated_at' => $rs->published_at,
                ];

                DB::table('articles')->insert($data);
            }
        });
    }

    protected function exportLinuxCommands()
    {
        LinuxCommand::chunk(100, function ($items) {
            foreach ($items as $rs) {
                $data = [
                    'type' => 'linux-command',
                    'original_id' => $rs->id,
                    'title' => sprintf('%s命令: %s', $rs->effect, $rs->name),
                    'url' => sprintf('linux/commands/%s', $rs->name),
                    'attributes' => json_encode([
                        'name' => $rs->name,
                        'effect' => $rs->effect,
                    ]),
                    'content' => $rs->text,
                    'created_at' => $rs->published_at,
                    'updated_at' => $rs->published_at,
                ];

                DB::table('articles')->insert($data);
            }
        });
    }

    protected function exportNews()
    {
        NewsPost::chunk(100, function ($items) {
            foreach ($items as $rs) {
                $data = [
                    'type' => 'news',
                    'original_id' => $rs->id,
                    'title' => $rs->title,
                    'url' => sprintf('news/%s', $rs->id),
                    'attributes' => json_encode([
                        'is_disabled' => $rs->is_disabled,
                        'source_url' => $rs->url,
                    ]),
                    'content' => $rs->text,
                    'created_at' => $rs->updated_at,
                    'updated_at' => $rs->updated_at,
                ];

                DB::table('articles')->insert($data);
            }
        });
    }
}
