<?php

namespace App\Support;

use Requests;
use SimpleXMLElement;

/**
 * Rss 解析器
 */
class RssParser
{
    public static function parse(string $url)
    {
        $content = static::fetch($url);
        if (!$content) {
            return;
        }

        $element = simplexml_load_string($content);

        $data[$element->getName()] = static::xmlToArray($element);

        return $data;
    }

    public static function fetch(string $url)
    {
        $response = Requests::get($url, [], [
            'timeout' => 60,
        ]);

        return $response->body;
    }

    public static function xmlToArray(SimpleXMLElement $element)
    {
        $attributes = $element->attributes();

        if ($element->count()) {
            $nodes = [];

            foreach ($element as $node) {
                $nodeName = $node->getName();
                if (!isset($nodes[$nodeName])) {
                    $nodes[$nodeName] = [];
                }

                $nodes[$nodeName][] = static::xmlToArray($node);
            }

            foreach ($nodes as $key => $value) {
                if (count($value) == 1) {
                    $nodes[$key] = $value[0];
                }
            }

            return $nodes;
        } else {
            if ($attributes->count()) {
                $data = [];
                foreach ($attributes as $attr) {
                    $data['_attr_'.$attr->getName()] = (string) $attr;
                }
                $data['text'] = (string) $element;
            } else {
                $data = (string) $element;
            }

            return $data;
        }
    }
}
