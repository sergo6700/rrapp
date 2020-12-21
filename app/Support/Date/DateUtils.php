<?php


namespace App\Support\Date;


/**
 * Class DateUtils
 * @package App\Support\Date
 */
class DateUtils
{
    /**
     * Get Case Of Month By Number
     * @param string $month
     * @return string
     */
    public static function getCaseOfMonthByNumber(string $month): string
    {
        $formatted_month = '';

        switch ($month) {
            case '01':
                $formatted_month = 'Января';
                break;
            case '02':
                $formatted_month = 'Февраля';
                break;
            case '03':
                $formatted_month = 'Марта';
                break;
            case '04':
                $formatted_month = 'Апреля';
                break;
            case '05':
                $formatted_month = 'Мая';
                break;
            case '06':
                $formatted_month = 'Июня';
                break;
            case '07':
                $formatted_month = 'Июля';
                break;
            case '08':
                $formatted_month = 'Августа';
                break;
            case '09':
                $formatted_month = 'Сентября';
                break;
            case '10':
                $formatted_month = 'Октября';
                break;
            case '11':
                $formatted_month = 'Ноября';
                break;
            case '12':
                $formatted_month = 'Декабря';
                break;
        }

        return $formatted_month;
    }

    /**
     * Get short day of week
     * @param string $dayOfWeek
     * @return string
     */
    public static function getShortDayOfWeek(string $dayOfWeek): string
    {
        $short_day_of_week = '';

        switch ($dayOfWeek) {
            case 'понедельник':
                $short_day_of_week = 'Пн';
                break;
            case 'вторник':
                $short_day_of_week = 'Вт';
                break;
            case 'среда':
                $short_day_of_week = 'Ср';
                break;
            case 'четверг':
                $short_day_of_week = 'Чт';
                break;
            case 'пятница':
                $short_day_of_week = 'Пт';
                break;
            case 'суббота':
                $short_day_of_week = 'Сб';
                break;
            case 'воскресенье':
                $short_day_of_week = 'Вс';
                break;
        }

        return $short_day_of_week;
    }

}