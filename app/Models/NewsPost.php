<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\SegmentWord;
use DB;
use Log;

class NewsPost extends Model
{
    use \App\Models\Concerns\TextAble;

    // 多态关系名称
    const MORPH_NAME = 'NP';

    protected $fillable = ['news_feed_id', 'is_disabled', 'sign', 'title', 'url', 'created_at'];

    public function feed()
    {
        return $this->belongsTo('App\Models\NewsFeed', 'news_feed_id');
    }

    public function keywords()
    {
        return $this->morphToMany('App\Models\Keyword', 'keywordable')->withPivot('tf', 'idf');
    }

    public function getContentAttribute()
    {
        $content = $this->text;

        $content = preg_replace('/href="(.+)"/iU', 'rel="external nofollow" target="_blank" href="\1"', $content);

        return $content;
    }

    /**
     * 获取文章分词信息
     */
    public function getWords()
    {
        $words = SegmentWord::dispose($this->title.$this->text);
        $words = SegmentWord::analyzeTermFrequency($words);

        return $words;
    }

    /**
     * 更新文章分词存储数据
     */
    public function updateWords()
    {
        $keywordIds = [];
        $words = $this->getWords();
        foreach ($words as $word) {
            $keyword = Keyword::where('text', $word['text'])->first();
            if (!$keyword) {
                $keyword = Keyword::create(['text' => $word['text']]);
            }
            $keywordIds[$keyword->id] = ['keyword_total' => $word['total']];
        }

        $this->keywords()->sync($keywordIds);
    }

    /**
     * 获取所有关键词总数
     */
    public static function getKeywordTotal()
    {
        return (int) DB::table('keywordables')
            ->where('keywordable_type', static::MORPH_NAME)
            ->sum('keyword_total');
    }
}
