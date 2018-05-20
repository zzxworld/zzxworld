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

    /**
     * 提取标题
     */
    public static function extractTitle($html)
    {
        if (preg_match('/<title>(.+)<\/title>/i', $html, $match)) {
            return trim($match[1]);
        }
    }

    /**
     * 提取图标
     */
    public static function extractIcon($html)
    {
        if (preg_match('/<link.+rel="shortcut icon".+href="(.+)">/iU', $html, $match)) {
            return trim($match[1]);
        }
    }

    /**
     * 判断是否支持响应式
     */
    public static function extractSupportResponsive($html)
    {
        return preg_match('/<meta.+name="viewport".+width=device-width.+>/i', $html, $match);
    }

    /**
     * 提取 RSS 订阅源
     */
    public static function extractFeeds($html)
    {
        if (preg_match_all('/<link.+rel="alternate".+type="application\/atom\+xml".+href="(.+)".+>/iU', $html, $matches)) {
            $feeds = [];
            foreach ($matches[1] as $i => $rs) {
                $feed  = ['url' => $rs];
                if (preg_match('/title="(.+)"/iU', $matches[0][$i], $match)) {
                    $feed['title'] = $match[1];
                }
                $feeds[] = $feed;
            }
            return $feeds;
        }
    }
}
