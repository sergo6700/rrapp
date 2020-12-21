<?php


namespace App\Support\Enum\Post;

use App\Support\Misc\Enum;

/**
 * Class VisibilityType
 *
 * @package App\Support\Enum\Post
 */
class VisibilityType extends Enum
{
    /**
     * @var int
     */
    public const FULL = 1;

    /**
     * @var int
     */
    public const PARTIAL = 2;

    /**
     * @var int
     */
    public const AUTH_ONLY = 3;

    /**
     * @return array|mixed
     */
    public static function getValues()
    {
        return [
            self::FULL => 'Неограниченный просмотр',
            self::PARTIAL  => 'Частичное ограничение',
            self::AUTH_ONLY => 'Полное ограничение'
        ];
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public static function getValue($id)
    {
        return self::getValues()[$id];
    }
}