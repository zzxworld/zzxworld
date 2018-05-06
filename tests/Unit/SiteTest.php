<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Site;
use App\Models\Tag;

class SiteTest extends TestCase
{
    use RefreshDatabase;

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
