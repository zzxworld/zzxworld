<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Tag;

class TagTest extends TestCase
{
    use RefreshDatabase;

    public function testBulkFindOrCreate()
    {
        $names = [];

        // 空元素测试
        $tags = Tag::findOrCreateMany($names);
        $this->assertEquals(collect(), $tags);

        // 正常测试
        $names = ['aaa', 'bbb', 'ccc'];
        $tags = Tag::findOrCreateMany($names);
        $this->assertEquals(3, $tags->count());
        $this->assertEquals($names, $tags->pluck('name')->toArray());

        // 重复测试
        $tags = Tag::findOrCreateMany($names);
        $this->assertEquals(3, $tags->count());
    }
}
