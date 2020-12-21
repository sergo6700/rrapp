<?php


namespace App\Http\Controllers\Web\Media;

use App\Http\Controllers\Controller;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\SeoService;
use Illuminate\View\View;
use App\Services\Web\MediaService;
use App\Http\Requests\Web\Media\MediaListRequest;

/**
 * Class MediaController
 *
 * @package App\Http\Controllers\Web\Media
 */
class MediaController extends Controller
{
    /**
     * Media service instance
     *
     * @var EventService
     */
    protected $media_service;

    /**
     * SeoService Instance
     *
     * @var SeoService
     */
    protected $seo_service;

    /**
     * MediaController constructor.
     *
     * @param MediaService $media_service Service
     * @param SeoService   $seo_service   Service
     */
    public function __construct(MediaService $media_service, SeoService $seo_service)
    {
        $this->media_service = $media_service;
        $this->seo_service = $seo_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param MediaListRequest $request Request
     *
     * @return View
     */
    public function index(MediaListRequest $request): View
    {
        $media = $this->media_service->index($request->all());
        $metaData = $this->seo_service->load(PageMetadata::MEDIA_ALIAS, $media);

        return view(
            'web.media.index'
        )->with(
            [
                'media' => $media,
                'title' =>  $metaData->title,
                'description' =>  $metaData->description,
            ]
        );
    }
}
