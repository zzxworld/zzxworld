<?php

namespace App\Models\Support;

class SiteParse
{
    /**
     * 提取 URL 协议
     */
    public static function extractURLScheme($url)
    {
        return parse_url($url, PHP_URL_SCHEME);
    }

    /**
     * 提取 URL 域名
     */
    public static function extractURLDomain($url)
    {
        return parse_url($url, PHP_URL_HOST);
    }
}
