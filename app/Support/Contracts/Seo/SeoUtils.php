<?php


namespace App\Support\Contracts\Seo;

/**
 * Interface SeoUtils
 * @package App\Support\Contracts\Seo
 */
interface SeoUtils
{
    /**
     * Get page meta title
     * @return string
     */
    public function getTitle();

    /**
     * Get page meta description
     * @return string
     */
    public function getDescription();
}