<?php

namespace App\Http\Controllers\Web\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Service\ServiceSendFeedbackRequest;
use App\Http\Requests\Web\Service\ServicesListRequest;
use App\Models\PageMetadata\PageMetadata;
use App\Models\Service\Service;
use App\Services\Web\ApplicationService;
use App\Services\Web\ServiceService;
use App\Services\Web\TagService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Support\Seo\SeoServiceUtils;


class ServiceController extends Controller
{
    /**
     * ID страницы "Оказание услуг по созданию онлайн-страницы в социальной сети Instagram",
     * где мы хотим отслеживать цели google analytics и Яндекс Метрику.
     *
     * @var int
     */
    const INSTAGRAM_PAGE_ID = 38;

    /**
     * ID страницы "Оказание услуг по содействию в размещении на электронных торговых площадках",
     * где мы хотим отслеживать цели google analytics и Яндекс Метрику.
     *
     * @var int
     */
    const MARKETPLACE_PAGE_ID = 39;

	/**
	 * Tag service instance
	 *
	 * @var TagService
	 */
	protected $tag_service;

	/**
	 * Service service instance
	 *
	 * @var ServiceService
	 */
	protected $service_service;

	/**
	 * Application service instance
	 *
	 * @var ApplicationService
	 */
	protected $application_service;

	/**
	 * ServiceController constructor.
	 *
	 * @param TagService $tag_service
	 * @param ServiceService $service_service
	 * @param ApplicationService $application_service
	 */
	public function __construct(
		TagService $tag_service,
		ServiceService $service_service,
		ApplicationService $application_service
	)
	{
		$this->tag_service = $tag_service;
		$this->service_service = $service_service;
		$this->application_service = $application_service;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @param ServicesListRequest $request
	 * @return View
     * @throws \ReflectionException
	 */
	public function index(ServicesListRequest $request): View
	{
		$services = $this->service_service->index($request->only('tags'));

        $selected_tag = null;
        $tags = $this->tag_service->index();
        if ($request->has('tags')) {
            $selected_tags = $this->tag_service->loadByName($request->get('tags'));
        }

		$seo = new SeoServiceUtils(PageMetadata::SERVICES_ALIAS, $services, $selected_tag);
        $title = $seo->getTitle();
        $description = $seo->getDescription();

		return view('web.services.index', compact('services', 'tags', 'selected_tags', 'title', 'description'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param Service $slug
	 * @return View
	 */
	public function show(Service $slug): View
	{
		$service = $this->service_service->load($slug);

        $mergeData = [];

		if ($slug->id === self::INSTAGRAM_PAGE_ID) {
            $mergeData = ['instagram_page_id' => self::INSTAGRAM_PAGE_ID];
        }

        if ($slug->id === self::MARKETPLACE_PAGE_ID) {
            $mergeData = ['marketplace_page_id' => self::MARKETPLACE_PAGE_ID];
        }

		return view('web.services.show', compact('service'), $mergeData);
	}

	/**
	 * Send feedback from service
	 *
	 * @param Service $service
	 * @param ServiceSendFeedbackRequest $request
	 * @return RedirectResponse
	 */
	public function sendFeedback(Service $service, ServiceSendFeedbackRequest $request): RedirectResponse
	{
		$application_raw = $this->application_service->formFromService($service, auth()->user(), $request->all());
		$this->application_service->createDefault($application_raw);

		return back()->with('success', true);
	}

    /**
     * Display a listing of the resource filtered by tags (using asynchronous HTTP (Ajax) request)
     *
     * @param ServicesListRequest $request
     * @return View
     */
	public function filterByTags(ServicesListRequest $request): View
    {
        if ($tags = $request->input('tags', [])) {
            $services = $this->service_service->filter($tags);
        } else {
            $services = $this->service_service->index([]);
        }

        return view('components.layouts.includes.list-services-with-pagination', compact('services'));
    }

}
