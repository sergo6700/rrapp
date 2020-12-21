<?php

namespace App\Http\Controllers\Web\Auth;

use App\Services\Web\RegistrationOfUsersFromSocialNetworksService;
use App\Services\Web\UloginService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Web\Auth\UloginRequest;

/**
 * Class UloginRegisterController
 * @package App\Http\Controllers\Web\Auth
 */
class UloginRegisterController extends Controller
{
    /**
     * @var string QUERY_PARAM_FOR_CALL_REGISTRATION_POPUP
     */
    public const QUERY_PARAM_FOR_CALL_REGISTRATION_POPUP = '?popup=registration-step-2';

    /**
     * @var string QUERY_PARAM_FOR_CALL_ERROR_POPUP
     */
    public const QUERY_PARAM_FOR_CALL_ERROR_POPUP = '?popup=registration-error';

    /**
     * Ulogin service instance
     *
     * @var UloginService
     */
    protected $ulogin_service;

    /**
     * Registration of users from social networks service instance
     *
     * @var RegistrationOfUsersFromSocialNetworksService
     */
    protected $registration_user_social;

    /**
     * UloginRegisterController constructor
     * 
     * @param UloginService $ulogin_service
     * @param RegistrationOfUsersFromSocialNetworksService $registration_user_social
     */
    public function __construct(UloginService $ulogin_service, RegistrationOfUsersFromSocialNetworksService $registration_user_social)
    {
        $this->middleware('guest');
        $this->ulogin_service = $ulogin_service;
        $this->registration_user_social = $registration_user_social;
    }


    /**
     * Handle the registration/authorization request for the user.
     *
     * @return RedirectResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function register(UloginRequest $request): RedirectResponse
    {
        $back = $this->getPreviousUrl();

        $response = $this->ulogin_service->get_data($request->all());
        if (!$response['success']) {
            return redirect()->to($back . self::QUERY_PARAM_FOR_CALL_ERROR_POPUP);
        }

        $userOfSocialNetwork = $response['user'];
        $user = $this->registration_user_social->existsUser([
            'uid_social_network' => $userOfSocialNetwork['network'] . $userOfSocialNetwork['uid']
        ]);

        if (!$user) {
            $user = $this->registration_user_social->register($userOfSocialNetwork);
            $back .= self::QUERY_PARAM_FOR_CALL_REGISTRATION_POPUP;
        } elseif ($user && empty($user->email)) {
            $back .= self::QUERY_PARAM_FOR_CALL_REGISTRATION_POPUP;
        }

        \Auth::login($user);
        return redirect()->to($back);
    }

    /**
     * Get previous URL
     *
     * @return string
     */
    private function getPreviousUrl() :string
    {
        $host = route('main.page');

        return strpos(url()->previous(), $host) === 0
            ? url()->previous()
            : $host;
    }
}
