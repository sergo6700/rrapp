<?php

namespace App\Http\Controllers\Web\Application;

use App\Http\Requests\Web\Application\ApplicationCreateRequest;
use App\Services\Web\ApplicationService;
use Illuminate\Http\JsonResponse;

/**
 * Class ApplicationController
 *
 * @package App\Http\Controllers\Web\Application
 */
class ApplicationController
{
	/**
	 * Application service instance
	 *
	 * @var ApplicationService
	 */
	protected $application_service;

	/**
	 * ApplicationController constructor.
	 *
	 * @param ApplicationService $application_service
	 */
	public function __construct(ApplicationService $application_service)
	{
		$this->application_service = $application_service;
	}

	/**
	 * Create application
	 *
	 * @param ApplicationCreateRequest $request
	 * @return JsonResponse
	 */
	public function create(ApplicationCreateRequest $request): JsonResponse
	{
		$this->application_service->create($request->all());

		return response()->json(['success' => true]);
	}

}
