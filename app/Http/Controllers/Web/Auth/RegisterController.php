<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Acl\User;
use App\Services\Web\PhoneService;
use App\Support\Validation\ValidationRules;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\ValidationTinOrRole;
use App\Rules\ValidRecaptcha;

/**
 * Class RegisterController
 *
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    protected $phone_service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PhoneService $phone_service)
    {
        $this->phone_service = $phone_service;

        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data Data array
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        $user_roles_in_company = Arr::pluck(config('handbook.user_roles'), 'id');
        $other_id = $user_roles_in_company[2];

        $rules = new ValidationRules();

        return Validator::make(
            $data,
            [
            'name' => ['required', 'string', "min:{$rules->name_min}", "max:{$rules->name_max}"],
            'email' => ['required', 'string', 'email', "max:{$rules->email_max}", 'unique:users'],
            'password' => ['required', 'string', "min:{$rules->password_min}", 'confirmed'],
            'password_confirmation' => ['required', 'string', "min:{$rules->password_confirmation_min}"],
            'role_in_company_id' => [
                    'required',
                    Rule::in($user_roles_in_company)
                ],
            'tin' => ['required', 'string', new ValidationTinOrRole($data)],
            'custom_role' => ['nullable', 'string'],
            'company_name' => ['required_unless:role_in_company_id,'. $other_id],
            'legal_address' => ['nullable', 'string'],
            'kpp' => ['nullable', 'digits:' . User::KPP_LENGTH],
            'ogrn' => ['nullable', "regex:{$rules->pattern_ogrn}"],
            'personalData' => 'required',
            'siteRules' => 'required',
            'phone' => ['required', "regex:{$rules->pattern_phone_without_prefix}", 'min:6'],
            'g-recaptcha-response' => ['required', new ValidRecaptcha]
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data Data array
     *
     * @return User
     */
    protected function create(array $data): User
    {
        if (array_key_exists('phone', $data) && !empty($data['phone'])) {
            $data['phone'] = $this->phone_service->addPrefix($data['phone']);
        }
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }
}
