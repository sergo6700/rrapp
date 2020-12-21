<?php


namespace App\Services\Web;

/**
 * Class PhoneService
 *
 * @package App\Services\Web
 */
class PhoneService
{
    const PREFIX = '+7';

    protected $pattern = '/^\+7/';

    /**
     * Add prefix to phone
     *
     * @param string $phone Phone number
     *
     * @return string
     */
    public function addPrefix(string $phone): string
    {
        if (!$phone) {
            return $phone;
        }

        preg_match($this->pattern, $phone, $matches);
        if (!$matches) {
            return self::PREFIX . $phone;
        }

        return $phone;
    }
}