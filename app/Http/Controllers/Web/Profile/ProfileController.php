<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Auth\RegisterStep2ProfileUpdateRequest;
use App\Http\Requests\Web\Profile\ProfileUpdateNotificationsRequest;
use App\Http\Requests\Web\Profile\ProfileUpdateRequest;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\EventService;
use App\Services\Web\UserService;
use App\Support\Seo\SeoUtils;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

/**
 * Class ProfileController
 *
 * @package App\Http\Controllers\Web\Profile
 */
class ProfileController extends Controller
{
	/**
	 * User service instance
	 *
	 * @var UserService
	 */
	protected $user_service;

	/**
	 * Event service instance
	 *
	 * @var EventService
	 */
	protected $event_service;

	/**
	 * ProfileController constructor.
	 *
	 * @param UserService $user_service
	 * @param EventService $event_service
	 */
	public function __construct(UserService $user_service, EventService $event_service)
	{
		$this->user_service = $user_service;
		$this->event_service = $event_service;
	}

	/**
	 * Show profile page
	 *
	 * @return View
	 */
	public function index(): View
	{
		$user = $this->user_service->load(auth()->user());
		$user->events_by_date = $this->event_service->groupByDate($user->events);

		$notifications = array_combine(Arr::pluck(config('handbook.notification_types'), 'id'), config('handbook.notification_types'));

        $seoUtils = new SeoUtils(PageMetadata::PROFILE_ALIAS);
        $title = $seoUtils->getTitle();

		return view('profile.index')->with(compact('user', 'notifications', 'title'));
	}

	/**
	 * Update user profile information
	 *
	 * @param ProfileUpdateRequest $request
	 * @return RedirectResponse
	 */
	public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
	{
		$this->user_service->update($request->all());

		return redirect()->route('profile.user.index');
	}

	/**
	 * Update user notification settings
	 *
	 * @param ProfileUpdateNotificationsRequest $request
	 * @return RedirectResponse
	 */
	public function updateNotifications(ProfileUpdateNotificationsRequest $request): RedirectResponse
	{
        $notifications = $request->notifications ?? [];
		$this->user_service->updateNotifications(auth()->user(), $notifications);

		return redirect()->back();
	}

    /**
     * @param RegisterStep2ProfileUpdateRequest $request
     * @return RedirectResponse
     */
    protected function step2updateProfile(RegisterStep2ProfileUpdateRequest $request)
    {
        $user = \Auth::user();
        if ($user) {
            $data = $request->only([
                'email',
                'role_in_company_id',
                'tin',
                'company_name',
                'legal_address',
                'kpp',
                'ogrn'
            ]);

            $user->update($data);
            $user->confirmEmailManually();
        }

        return redirect()->back();
    }
}
