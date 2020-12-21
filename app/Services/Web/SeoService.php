<?php


namespace App\Services\Web;

use App\Support\DTO\Seo\MetaData;
use App\Support\Seo\SeoUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Support\Contracts\Seo\SeoUtils as SeoUtilsContract;

/**
 * Class SeoService
 *
 * @package App\Services\Web
 */
class SeoService
{

    /**
     * Load method
     *
     * @param string                    $type      Page alias
     * @param LengthAwarePaginator|null $paginator Paginator instance
     *
     * @return MetaData
     */
    public function load(string $type, LengthAwarePaginator $paginator = null): MetaData
    {
        $seoUtils = new SeoUtils($type, $paginator);

        return new MetaData(
            [
                'title' => $seoUtils->getTitle(),
                'description' => $seoUtils->getDescription(),
            ]
        );
    }

}
