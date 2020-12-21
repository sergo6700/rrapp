<?php

namespace App\Http\Controllers\Web\Documents;

use App\Http\Controllers\Controller;
use App\Models\Docs\Document;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\DocumentService;
use App\Services\Web\SeoService;
use Illuminate\View\View;

/**
 * Class DocumentController
 *
 * @package App\Http\Controllers\Web\Documents
 */
class DocumentController extends Controller
{
    /**
     * Document service instance
     *
     * @var DocumentService
     */
    protected $document_service;

    /**
     * SeoService Instance
     *
     * @var SeoService
     */
    protected $seo_service;

    /**
     * DocumentController constructor.
     *
     * @param DocumentService $document_service DocumentService Instance
     * @param SeoService      $seo_service      SeoService Instance
     */
    public function __construct(DocumentService $document_service, SeoService $seo_service)
    {
        $this->document_service = $document_service;
        $this->seo_service = $seo_service;
    }

    /**
     * Documents list
     *
     * @return View
     * @throws \ReflectionException
     */
    public function index(): View
    {
        $documents = $this->document_service->index();
        $metaData = $this->seo_service->load(PageMetadata::DOCS_ALIAS, $documents);

        return view(
            'web.documents-page.index'
        )->with(
            [
                'documents' => $documents,
                'title' =>  $metaData->title,
                'description' =>  $metaData->description,
            ]
        );
    }

    /**
     * Certain document show
     *
     * @param Document $slug Model
     *
     * @return View
     */
    public function show(Document $slug): View
    {
        $document = $this->document_service->load($slug);

        return view('web.documents-page.show', compact('document'));
    }

}
