<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Support\SegmentWord;

class NewsPost extends Model
{
    use \App\Models\Concerns\TextAble;

    protected $fillable = ['news_feed_id', 'is_disabled', 'sign', 'title', 'url', 'created_at'];

    public function feed()
    {
        return $this->belongsTo('App\Models\NewsFeed', 'news_feed_id');
    }

    public function keywords()
    {
        return $this->morphToMany('App\Models\Keyword', 'keywordable');
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
        $words = $this->getWords();
        $keywords = Keyword::whereIn('text', array_map(function ($word) {
            return $word['text'];
        }, $words))->get();

        $keywordIds = [];
        foreach ($words as $word) {
            $keyword = $keywords->where('text', $word['text'])->first();
            if (!$keyword) {
                $keyword = Keyword::create(['text' => $word['text']]);
            }
            $keywordIds[$keyword->id] = ['tf' => $word['tf']];
        }

        $this->keywords()->sync($keywordIds);
    }
}
