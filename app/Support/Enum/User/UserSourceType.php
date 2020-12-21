<?php


namespace App\Support\Enum\User;


class UserSourceType
{
    /**
     * @var int
     */
    public const SITE = 1;

    /**
     * @var int
     */
    public const IFRAME = 2;

    /**
     * @return array
     */
    public static function getValues() :array
    {
        return [
            self::SITE => 'сайт',
            self::IFRAME  => 'iframe',
        ];
    }

    /**
     * @param int $id
     * @return mixed
     */
    public static function getValue(int $id) :string
    {
        return self::getValues()[$id];
    }
}