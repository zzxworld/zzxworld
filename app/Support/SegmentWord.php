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
}
