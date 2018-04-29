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

    public static function dispose(string $text)
    {
        $response = Requests::post(static::getServiceURL(), [
            'timeout' => 10,
        ], ['text' => $text]);

        $result = (array) json_decode($response->body, true);

        if (!isset($result['words'])) {
            return [];
        }

        return $result['words'];
    }

    /**
     * 统计词频
     */
    public static function analyzeTermFrequency(array $words)
    {
        $total = count($words);
        $words = array_count_values($words);
        $words = array_map(function ($key, $value) use ($total) {
            return [
                'text' => $key,
                'count' => $value,
                'freq' => $value / $total,
            ];
        }, array_keys($words), array_values($words));

        usort($words, function ($a, $b) {
            if ($a['count'] > $b['count']) {
                return -1;
            } else if ($a['count'] == $b['count']) {
                return 0;
            } else {
                return 1;
            }
        });

        return $words;
    }
}
