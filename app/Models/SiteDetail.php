<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Support\SiteParse;
use Requests;

class SiteDetail extends Model
{
    protected $fillable = ['title', 'icon'];

    /**
     * 站点详情
     */
    public function site()
    {
        return $this->belongsTo('App\Models\Site');
    }

    /**
     * 抓取站点详情
     */
    public static function fetch(Site $site)
    {
        $response = Requests::get($site->url);
        $content = $response->body;

        // 提取并保存站点标题
        $data = [
            'title' => SiteParse::extractTitle($content),
        ];

        // 提取并保存站点图标
        $icon = SiteParse::extractIcon($content);
        if (preg_match('/^\/\//', $icon)) {
            $icon = $site->scheme.':'.$icon;
        }

        if (preg_match('/^http[s]?:/', $icon)) {
            $icon = Requests::get($icon);
            $icon = 'data:image/png;base64,'.base64_encode($icon->body);
        }

        $data['icon'] = $icon;

        if ($site->detail) {
            $site->detail()->update($data);
        } else {
            $site->detail()->create($data);
        }

        // 提取并保存 RSS 源
        $urls = [];
        $feeds = SiteParse::extractFeeds($content);

        if ($feeds) {
            foreach ($feeds as $feed) {
                $site->feeds()->updateOrCreate([
                    'url' => $feed['url'],
                ], $feed);

                $urls[] = $feed['url'];
            }
        }

        $site->feeds()->whereNotIn('url', $urls)->delete();
    }
}
