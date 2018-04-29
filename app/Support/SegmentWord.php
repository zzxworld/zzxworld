<?php

namespace App\Support;

use Requests;

/**
 * 分词服务
 */
class SegmentWord
{
    protected static $url;

    public static function getServiceURL()
    {
        if (!static::$url) {
            $config = config('segmentword');
            static::$url = sprintf('http://%s:%s/segment',
                $config['host'], $config['port']);
        }

        return static::$url;
    }

    /**
     * 格式化待分词文本
     */
    public static function formatText(string $text)
    {
        $text = strip_tags($text);

        return $text;
    }

    public static function dispose(string $text)
    {
        $text = static::formatText($text);

        $response = Requests::post(static::getServiceURL(), [
            'timeout' => 10,
        ], ['text' => $text]);

        $result = (array) json_decode($response->body, true);

        if (!isset($result['words'])) {
            return [];
        }

        return array_filter($result['words'], function ($word) {
            return mb_strlen($word) < 63;
        });
    }

    /**
     * 统计词频
     */
    public static function analyzeTermFrequency(array $words)
    {
        $words = array_count_values($words);
        $words = array_map(function ($key, $value) {
            return [
                'text' => $key,
                'total' => $value,
            ];
        }, array_keys($words), array_values($words));

        usort($words, function ($a, $b) {
            if ($a['total'] > $b['total']) {
                return -1;
            } else if ($a['total'] == $b['total']) {
                return 0;
            } else {
                return 1;
            }
        });

        return $words;
    }
}
