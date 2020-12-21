<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use App\Models\Post\NewsItem;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\ArticleService;
use App\Services\Web\DocumentService;
use App\Services\Web\EventService;
use App\Services\Web\HelpService;
use App\Services\Web\SliderService;
use App\Support\Seo\SeoUtils;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class MainController
 *
 * @package App\Http\Controllers\Web\Main
 */
class MainController extends Controller
{
    /**
     * @var integer
     */
    const ID_HOT_LINE_FOR_BUSINESS_NEWS = 88;

    /**
     * Report that this is the main page of the site
     *
     * @var bool
     */
    const IS_MAIN_PAGE = true;

    /**
     * Index page
     *
     * @return Factory|View
     */
    public function index()
    {
        $slides = (new SliderService)->get();
        $events_grouped_by_date = (new EventService)->getEventsForMainPage();
        $services = (new HelpService)->getServicesForMainPage();
        $articles = (new ArticleService)->getArticlesForMainPage();
        $documents = (new DocumentService)->getDocumentsForMainPage();

        $hot_news = NewsItem::find(self::ID_HOT_LINE_FOR_BUSINESS_NEWS);
        $isMainPage = self::IS_MAIN_PAGE;

        $seoUtils = new SeoUtils(PageMetadata::MAIN_ALIAS);
        $title = $seoUtils->getTitle();
        $description = $seoUtils->getDescription();

        return view(
            'home', compact(
                'events_grouped_by_date',
                'services',
                'articles',
                'documents',
                'hot_news',
                'slides',
                'isMainPage',
                'title',
                'description'
            )
        );
    }
}
