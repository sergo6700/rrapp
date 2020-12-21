<?php


namespace App\Support\Post;


/**
 * Class TextHelper
 * @package App\Support\Post
 */
class TextHelper
{
    /**
     * Cut text to limit
     * @param string $source
     * @param int $limit
     * @return string
     */
    public static function cutTextToLimit(string $source, int $limit): string
    {
        $string = strip_tags($source);
        $string = substr($string, 0, $limit);
        $string = rtrim($string, '!,.-');
        $string = substr($string, 0, strrpos($string, ' '));
        return $string.'...';
    }

}