<?php

namespace App\Http\Controllers\Web\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\News\NewsListRequest;
use App\Models\PageMetadata\PageMetadata;
use App\Models\Post\NewsItem;
use App\Services\Web\NewsItemService;
use App\Services\Web\SeoService;
use Illuminate\View\View;

/**
 * Class NewsController
 *
 * @package App\Http\Controllers\Web\News
 */
class NewsController extends Controller
{
    /**
     * News item service instance
     *
     * @var NewsItemService
     */
    protected $news_item_service;

    /**
     * SeoService Instance
     *
     * @var SeoService
     */
    protected $seo_service;

    /**
     * NewsController constructor.
     *
     * @param NewsItemService $news_item_service NewsItemService Instance
     * @param SeoService      $seo_service       SeoService Instance
     */
    public function __construct(NewsItemService $news_item_service, SeoService $seo_service)
    {
        $this->news_item_service = $news_item_service;
        $this->seo_service = $seo_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param NewsListRequest $request Request
     *
     * @return View
     */
    public function index(NewsListRequest $request): View
    {
        $news = $this->news_item_service->index($request->all());
        $metaData = $this->seo_service->load(PageMetadata::NEWS_ALIAS, $news);

        return view(
            'web.news.index'
        )->with(
            [
                'news' => $news,
                'title' =>  $metaData->title,
                'description' =>  $metaData->description,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param NewsItem $slug Model
     *
     * @return View
     */
    public function show(NewsItem $slug): View
    {
        $pieceOfNews = $this->news_item_service->load($slug);

        $similar = $this->news_item_service->getSimilar($pieceOfNews);

        return view('web.news.show', compact('pieceOfNews', 'similar'));
    }

}
