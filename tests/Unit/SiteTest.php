<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Support\SiteParse;
use App\Models\Site;
use App\Models\Tag;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    public function urlProvider()
    {
        return [
            ['https://www.zzxworld.com/', 'https', 'www.zzxworld.com'],
            ['http://zzxworld.com/other/parts.php', 'http', 'zzxworld.com'],
        ];
    }

    public function htmlProvider()
    {
        return [
            [file_get_contents(__DIR__.'/Data/site_php_net.html'), [
                'title' => 'PHP: parse_url - Manual',
                'icon' => 'http://php.net/favicon.ico',
                'support_responsive' => true,
                'feeds' => [
                    [
                        'url' => 'http://php.net/releases/feed.php',
                        'title' => 'PHP Release feed',
                    ],
                    [
                        'url' => 'http://php.net/feed.atom',
                        'title' => 'PHP: Hypertext Preprocessor'
                    ],
                ],
            ]],
            [file_get_contents(__DIR__.'/Data/site_bilibili_com.html'), [
                'title' => '哔哩哔哩 (゜-゜)つロ 干杯~-bilibili',
                'icon' => '//static.hdslb.com/images/favicon.ico',
                'support_responsive' => false,
                'feeds' => [],
            ]],
        ];
    }

    /**
     * @dataProvider urlProvider
     */
    public function testExtractURL($url, $scheme, $domain)
    {
        $this->assertEquals($scheme, SiteParse::extractURLScheme($url));
        $this->assertEquals($domain, SiteParse::extractURLDomain($url));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testExtractTitle($html, $info)
    {
        $this->assertEquals($info['title'], SiteParse::extractTitle($html));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testExtractIcon($html, $info)
    {
        $this->assertEquals($info['icon'], SiteParse::extractIcon($html));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testExtractSupportResponsive($html, $info)
    {
        $this->assertEquals($info['support_responsive'], SiteParse::extractSupportResponsive($html));
    }

    /**
     * @dataProvider htmlProvider
     */
    public function testExtractFeeds($html, $info)
    {
        $feeds = SiteParse::extractFeeds($html);
        $this->assertEquals(count($info['feeds']), count($feeds));

        foreach ($info['feeds'] as $i => $feed) {
            $this->assertEquals($feed['title'], $feeds[$i]['title']);
            $this->assertEquals($feed['url'], $feeds[$i]['url']);
        }
    }

    public function testCreateWithTags()
    {
        $site = new Site;
        $site->name = 'zzxworld';
        $site->url = 'https://www.zzxworld.com';
        $site->save();

        $this->assertInstanceOf(Site::class, $site);
        $this->assertEquals('https', $site->scheme);
        $this->assertEquals('www.zzxworld.com', $site->domain);
    }
}
