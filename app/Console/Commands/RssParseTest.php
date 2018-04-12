<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Support\RssParser;

class RssParseTest extends Command
{
    protected $signature = 'rss:parse-test {--url=}';
    protected $description = 'Rss 解析测试';

    public function handle()
    {
        $url = $this->option('url');
        if (!$url) {
            return;
        }

        $data = RssParser::parse($url);

        print_r($data);
    }
}
