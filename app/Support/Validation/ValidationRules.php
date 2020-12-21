<?php


namespace App\Support\Validation;

use App\Support\Seo\SeoUtils;

/**
 * Class Value
 * @package App\Support\Validation
 */
class ValidationRules
{
    /**
     * Min password value
     *
     * @var int
     */
    public $password_min = 8;

    /**
     * Min password_confirmation value
     *
     * @var int
     */
    public $password_confirmation_min = 8;

    /**
     * Min name value
     *
     * @var int
     */
    public $name_min = 2;

    /**
     * Maximum name value
     *
     * @var int
     */
    public $name_max = 255;

    /**
     * Maximum email value
     *
     * @var int
     */
    public $email_max = 255;

    /**
     * Maximum tin value
     *
     * @var int
     */
    public $tin_max = 300;

    /**
     * Min position value
     *
     * @var int
     */
    public $position_min = 0;

    /**
     * Maximum position value
     *
     * @var int
     */
    public $position_max = 4000000000;

    /**
     * Min string value
     *
     * @var int
     */
    public $string_min = 2;

    /**
     * Maximum string value
     *
     * @var int
     */
    public $string_max = 255;

    /**
     * Min visitors count value
     *
     * @var int
     */
    public $visitors_count_min = 0;

    /**
     * Min visited count value
     *
     * @var int
     */
    public $visited_count_min = 0;

    /**
     * Min class_name value
     *
     * @var int
     */
    public $class_name_min = 3;

    /**
     * Maximum class_name value
     *
     * @var int
     */
    public $class_name_max = 100;

    /**
     * Min month value
     *
     * @var int
     */
    public $month_min = 1;

    /**
     * Maximum month value
     *
     * @var int
     */
    public $month_max = 12;

    /**
     * Maximum meta description value
     *
     * @var int
     */
    public $max_length_description = SeoUtils::MAX_LENGTH_DESCRIPTION;

    /**
     * Phone check pattern
     *
     * @var string
     */
    public $pattern_phone_without_prefix = '/\([0-9]{3}\)[0-9]{7}/';

    /**
     * Phone check pattern
     *
     * @var string
     */
    public $pattern_phone = '/\+7\([0-9]{3}\)[0-9]{7}/';

    /**
     * File check pattern
     *
     * @var string
     */
    public $pattern_file = '/^(.*)(\.)(pdf|doc|docx|xls|xlsx)$/i';

    /**
     * Image check pattern
     *
     * @var string
     */
    public $pattern_image = '/^(.*)(\.)(jpg|jpeg|jpe|png|gif|bmp|svg|webp)$/i';

    /**
     * Паттерн для проверки ОГРН
     *
     * @var string
     */
    public $pattern_ogrn = '/^(\d{13}|\d{15})$/';

    /**
     * Паттерн для проверки ИНН
     * 
     * @var string
     */
    public $pattern_tin = '/^(\d{10}|\d{12})$/';
}