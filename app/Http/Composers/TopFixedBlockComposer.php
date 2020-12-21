<?php

namespace App\Http\Composers;

use App\Services\Web\EventService;
use App\Services\Web\NewsItemService;
use App\Services\Web\ServiceService;
use Illuminate\Contracts\View\View;

/**
 * Class TopFixedBlockComposer
 *
 * @package App\Http\Composers
 */
class TopFixedBlockComposer
{
    /**
     * Event service instance
     *
     * @var EventService
     */
    protected $event_service;

    /**
     * News item service instance
     *
     * @var NewsItemService
     */
    protected $news_item_service;

    /**
     * Service service instance
     *да
     * @var ServiceService
     */
    protected $service_service;

    /**
     * TopFixedBlockComposer constructor.
     *
     * @param EventService    $event_service     Service
     * @param NewsItemService $news_item_service Service
     * @param ServiceService  $service_service   Service
     */
    public function __construct(
        EventService $event_service,
        NewsItemService $news_item_service,
        ServiceService $service_service
    ) {
        $this->event_service = $event_service;
        $this->news_item_service = $news_item_service;
        $this->service_service = $service_service;
    }

    /**
     * Set view variables for top fixed blocks
     *
     * @param View $view interface
     *
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('latest_events', $this->event_service->getLatestForFixedBlock());
        $view->with('latest_news', $this->news_item_service->getLatestForFixedBlock());
        $view->with('latest_services', $this->service_service->getLatestForFixedBlock());
    }


}
