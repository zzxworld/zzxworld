<?php

namespace App\Console\Commands\Site;

use Illuminate\Console\Command;
use DomDocument;
use App\Models\Support\SiteParse;
use App\Models\Site;
use Log;

class ImportFromBookmark extends Command
{
    protected $signature = 'site:import-from-bookmark {--file=}';
    protected $description = '从书签导入站点';

    public function handle()
    {
        $filename = $this->option('file');
        if (!$filename) {
            return false;
        }

        if (!file_exists($filename)) {
            return $this->error('file not exists.');
        }

        $dom = new DomDocument;
        $dom->loadHTMLFile($filename);

        $links = $dom->getElementsByTagName('a');

        foreach($links as $link) {
            $url = $link->getAttribute('href');

            $this->saveSite([
                'scheme' => SiteParse::extractURLScheme($url),
                'domain' => SiteParse::extractURLDomain($url),
                'name' => $link->textContent,
                'icon' => $link->getAttribute('icon'),
                'created_at' => date('Y-m-d H:i:s', $link->getAttribute('add_date')),
            ]);
        }
    }

    protected function saveSite(array $attributes)
    {
        try {
            $site = Site::create($attributes);
            $site->detail()->create($attributes);
        } catch (\PDOException $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
