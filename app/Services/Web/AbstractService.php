<?php

namespace App\Services\Web;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class AbstractService
 * @package App\Services\Web
 */
abstract class AbstractService
{
    protected $current_route;

    public function __construct()
    {
        $this->current_route = \Request::route()->getName();
    }

    /**
     * Get latest models for mini calendar on top of pages
     *
     * @return Collection
     */
    abstract public function getLatestForFixedBlock():Collection;
}