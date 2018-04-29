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
        return $this->morphToMany('App\Models\Keyword', 'keywordable')->withPivot('keyword_total');
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
     * 获取包含权重数据的关键词
     */
    public function getKeywordsWithTFIDF($limit=0)
    {
        $documentTotal = static::count();
        $postKeywordTotal =  $this->keywords->map(function ($rs) {
            return $rs->pivot->keyword_total;
        })->sum();

        $postKeywordCounts = [];
        $result = DB::table('keywordables')
            ->select(DB::raw('keyword_id, count(id) as total'))
            ->where('keywordable_type', static::MORPH_NAME)
            ->whereIn('keyword_id', $this->keywords->map(function ($rs) {
                return $rs->id;
            }))->groupBy('keyword_id')->get();
        foreach ($result as $rs) {
            $postKeywordCounts[$rs->keyword_id] = $rs->total;
        }

        $keywords = $this->keywords()->where('is_empty', false)->get();
        foreach ($keywords as $keyword) {
            $keyword->post_total = $postKeywordTotal;
            $keyword->in_post_total = $keyword->pivot->keyword_total;
            $keyword->document_total = $documentTotal;
            $keyword->in_document_total = $postKeywordCounts[$keyword->id];
        }

        $keywords = $keywords->sortByDesc('tfidf');

        if($limit > 0) {
            $keywords = $keywords->slice(0, $limit);
        }

        return $keywords;
    }
}
