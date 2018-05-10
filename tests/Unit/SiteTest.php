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

    public function testCreateWithTags()
    {
        $tags = Tag::findOrCreateMany(['aaa', 'bbb']);
        $site = Site::create([
            'url' => 'https://www.zzxworld.com',
            'name' => 'zzxworld',
        ]);
        $site->tags()->sync([1, 2]);

        $this->assertEquals(2, $site->tags()->count());
    }
}
