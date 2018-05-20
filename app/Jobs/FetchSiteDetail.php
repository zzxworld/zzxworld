<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Site;
use App\Models\SiteDetail;
use Log;

class FetchSiteDetail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $siteId;

    public function __construct($id)
    {
        $this->siteId = $id;
    }

    public function handle()
    {
        $site = Site::find($this->siteId);
        if (!$site) {
            Log::warning('['.get_class($this).'] invalid site.', ['id' => $this->siteId]);
            return;
        }

        SiteDetail::fetch($site);
    }
}
