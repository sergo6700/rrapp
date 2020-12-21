<?php


namespace App\Services\Web;


use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class HelpService
 * @package App\Services\Web
 */
class HelpService
{
    /**
     * Get services for main page
     * @return Builder[]|Collection
     */
    public function getServicesForMainPage() {
        // SQL queries
        $priorityQuery = Service::with(['tags'])
            ->where('is_show_on_main', true)
            ->where('position', '>', 0)
            ->orderBy('position', 'ASC')
            ->latest();

        $secondaryQuery = Service::with(['tags'])
            ->where('is_show_on_main', true)
            ->where('position', '=', 0)
            ->latest();

        // get a collections
        $priorityCollection = $priorityQuery->get();
        $secondaryCollection = $secondaryQuery->get();
        return $unionCollection = $priorityCollection->merge($secondaryCollection);
    }
}
