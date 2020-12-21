<?php

namespace App\Http\Controllers\Web\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Post\ArticleListRequest;
use App\Models\Post\Article;
use App\Services\Web\ArticleService;
use App\Models\PageMetadata\PageMetadata;
use App\Support\Filter\Filter;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use App\Services\Web\SeoService;

/**
 * Class ArticleController
 *
 * @package App\Http\Controllers\Web\Articles
 */
class ArticleController extends Controller
{
    /**
     * ArticleService Instance
     *
     * @var ArticleService
     */
    protected $article_service;

    /**
     * SeoService Instance
     *
     * @var SeoService
     */
    protected $seo_service;

    /**
     * ArticleController constructor.
     *
     * @param ArticleService $article_service ArticleService Instance
     * @param SeoService     $seo_service     SeoService Instance
     */
    public function __construct(ArticleService $article_service, SeoService $seo_service)
    {
        $this->article_service = $article_service;
        $this->seo_service = $seo_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ArticleListRequest $request Request
     *
     * @return Factory|View
     */
    public function index(ArticleListRequest $request)
    {
        $data = $this->article_service->index(new Filter(
            $request->input('month'),
            $request->input('year'),
            $request->input('show_video')
        ));

        $metaData = $this->seo_service->load(PageMetadata::ARTICLES_ALIAS, $data['articles']);

        return view(
            'web.articles.index'
        )->with(
            [
                'articles' => $data['articles'],
                'article_view_type' =>  $data['article_view_type'],
                'title' =>  $metaData->title,
                'description' =>  $metaData->description,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Article $slug Model
     *
     * @return Factory|View
     */
    public function show(Article $slug)
    {
        $similar = $this->article_service->getSimilar($slug);

        $article = $this->article_service->load($slug);

        return view('web.articles.show', compact('article', 'similar'));
    }
}
