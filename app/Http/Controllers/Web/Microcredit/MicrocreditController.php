<?php

namespace App\Http\Controllers\Web\Microcredit;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Microcredit\GetMicrocreditProducts;
use App\Http\Resources\Microcredit\MicrocreditProductResource;
use App\Services\Web\MicrocreditService;

/**
 * Class MicrocreditController
 *
 * @package App\Http\Controllers\Web\Microcredit
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('web.microcredit.index');
    }

    /**
     * @param GetMicrocreditProducts $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function calculation(GetMicrocreditProducts $request)
    {
        $products = $this->microcredit_service->calculate($request->all());

        return view('web.microcredit.calculation', ['products' => MicrocreditProductResource::collection($products)->toArray($request)]);
    }
}
