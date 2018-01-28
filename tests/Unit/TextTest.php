<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Text;

class TextTest extends TestCase
{
    /**
     * 测试切分英文内容
     */
    public function testSegmentEnglish()
    {
        $texts = collect([
            'Once the test has be',
            'en generated, you ma',
            'y define test method',
            's as you normally wo',
            'uld using PHPUnit. T',
            'o run your tests, ex',
            'ecute the phpunit co',
            'mmand from your term',
            'inal',
        ]);

        $this->assertEquals(Text::segment($texts->implode(''), 20), $texts);
    }

    /**
     * 测试切分中文内容
     */
    public function testSegmentMixText()
    {
        $texts = collect([
            'Vue (读音 /vjuː/，类似于 v',
            'iew) 是一套用于构建用户界面的渐进式',
            '框架。',
        ]);

        $this->assertEquals(Text::segment($texts->implode(''), 20), $texts);
    }
}
