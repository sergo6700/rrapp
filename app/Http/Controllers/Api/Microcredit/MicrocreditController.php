<?php

namespace App\Http\Controllers\Api\Microcredit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Microcredit\GetMicrocreditProducts;
use App\Http\Resources\Microcredit\MicrocreditProductResource;
use App\Services\Web\MicrocreditService;

/**
 * Class MicrocreditController
 *
 * @package App\Http\Controllers\Api\Microcredit
 */
class MicrocreditController extends Controller
{
    /**
     * Microcredit service instance
     *
     * @var MicrocreditService
     */
    protected $microcredit_service;

    /**
     * MicrocreditController constructor.
     *
     * @param MicrocreditService $microcredit_service
     */
    public function __construct(MicrocreditService $microcredit_service)
    {
        $this->microcredit_service = $microcredit_service;
    }

    /**
     * Get best suited products
     *
     * @param GetMicrocreditProducts $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(GetMicrocreditProducts $request)
    {
        return MicrocreditProductResource::collection($this->microcredit_service->calculate($request->all()));
    }
}
