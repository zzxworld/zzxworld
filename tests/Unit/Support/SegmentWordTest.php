<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Support\SegmentWord;

class SegmentWordTest extends TestCase
{
    public function testClearHTML()
    {
        $text = '<p><a rel="external nofollow" target="_blank" href="https://www.kaidee.com/">Kaidee</a>作为泰国点对点分类广告市场的领导者，每月访问量超过2000万，拥有巨大的市场规模与潜力。此外，还有其他一些分类广告玩家，通常专注于汽车或住宅公寓，然而除了<a rel="external nofollow" target="_blank" href="https://www.pantipmarket.com/">PantipMarket</a>，鲜有表现出众者。</p>';
        $this->assertEquals('Kaidee作为泰国点对点分类广告市场的领导者，每月访问量超过2000万，拥有巨大的市场规模与潜力。此外，还有其他一些分类广告玩家，通常专注于汽车或住宅公寓，然而除了PantipMarket，鲜有表现出众者。', SegmentWord::formatText($text));
    }

    public function testClearHTMLEntities()
    {
        $text = 'Lazada由Rocket&nbsp;Internet创立于2011年.&amp;';
        $this->assertEquals('Lazada由Rocket Internet创立于2011年. ', SegmentWord::formatText($text));
    }

    public function testClearCodeBlock()
    {
        $text = 'aa<pre class="highlight ruby"><code><span class="n">set</span> <span class="ss">:linked_files</span><span class="p">,</span> <span class="n">fetch</span><span class="p">(</span><span class="ss">:linked_files</span><span class="p">,</span> <span class="p">[]).</span><span class="nf">push</span><span class="p">(</span><span class="s1">\'config/database.yml\'</span><span class="p">,</span> <span class="s1">\'config/secrets.yml\'</span><span class="p">,</span> <span class="s1">\'config/cable.yml\'</span><span class="o">...</span><span class="p">)</span>
</code></pre> bb';
        $this->assertEquals("aa  bb", SegmentWord::formatText($text));
    }
}
