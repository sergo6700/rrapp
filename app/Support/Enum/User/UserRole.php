<?php


namespace App\Support\Enum\User;

use App\Support\Misc\Enum;

/**
 * Class UserRole
 * @package App\Support\Enum\User
 */
class UserRole extends Enum
{
    /**
     * @var int
     */
    public const USER = 1;

    /**
     * @var int
     */
    public const MODERATOR = 2;

    /**
     * @var int
     */
    public const ADMIN = 3;

    /**
     * Получает массив со всеми значениями ENUM'а
     * @return array|mixed
     */
    public static function getValues()
    {
        return [
            self::USER      => 'Пользователь',
            self::MODERATOR => 'Модератор',
            self::ADMIN     => 'Администратор',
        ];
    }

    /**
     * Получает строчное значение ENUM'а по $id
     * @param $id
     * @return mixed
     */
    public static function getValue($id)
    {
        return self::getValues()[$id];
    }
}
