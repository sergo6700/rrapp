<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class ResetPasswordController
 * @package App\Http\Controllers\Web\Auth
 */
class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

	/**
	 * Display the password reset view for the given token.
	 *
	 * If no token is present, display the link request form.
	 *
	 * @param Request $request
	 * @param null $token
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function showResetForm(Request $request, $token = null) :RedirectResponse
	{
		return redirect()->route('main.page')->with([
			'password_reset_token' => $token,
			'password_reset_email' => $request->email,
		]);
	}

	/**
	 * Get the response for a successful password reset.
	 *
	 * @param Request $request
	 * @param $response
	 * @return JsonResponse
	 */
	protected function sendResetResponse(Request $request, $response): JsonResponse
	{
		return response()->json(['status' => trans($response)]);
	}

	/**
	 * Get the response for a failed password reset.
	 *
	 * @param Request $request
	 * @param $response
	 * @return JsonResponse
	 */
	protected function sendResetFailedResponse(Request $request, $response): JsonResponse
	{
		return response()->json(['error' => trans($response)]);
	}

}
