<?php

namespace App\Http\Controllers\Web\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Event\RegistrationFromThirdPartySiteRequest;
use App\Models\Event\Event;
use App\Services\Web\RegistrationFromThirdPartySiteService;


/**
 * Class RegistrationFromThirdPartySiteController
 * @package App\Http\Controllers\Web\Events
 */
class RegistrationFromThirdPartySiteController extends Controller
{
    /**
     * Successfully submitted form
     * @var
     */
    protected $sentSuccessfully;

    /**
     * Maximum number of participants reached
     *
     * @var
     */
    protected $hasLimitReached;

    /**
     * RegistrationFromThirdPartySiteController service instance
     *
     * @var RegistrationFromThirdPartySiteService
     */
    protected $service;

    /**
     * RegistrationFromThirdPartySiteController constructor.
     * @param RegistrationFromThirdPartySiteService $service
     */
    public function __construct(RegistrationFromThirdPartySiteService $service)
    {
        $this->service = $service;
    }

    public function index(Event $event)
    {
        return view('web.iframe.index', [
            'event' => $event,
            'sentSuccessfully' => $this->sentSuccessfully,
            'hasLimitReached' => $this->hasLimitReached
        ]);
    }

    /**
     * @param RegistrationFromThirdPartySiteRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function register(Event $event, RegistrationFromThirdPartySiteRequest $request)
    {
        if ($this->service->isLimitReached($event)) {
            return view('web.iframe.index', [
                'event' => $event,
                'sentSuccessfully' => $this->sentSuccessfully,
                'hasLimitReached' => !$this->hasLimitReached,
            ]);
        }

        $this->service->register($event, $request->all());

        return view('web.iframe.index', [
            'event' => $event,
            'sentSuccessfully' => !$this->sentSuccessfully,
            'hasLimitReached' => $this->hasLimitReached,
        ]);
    }
}
