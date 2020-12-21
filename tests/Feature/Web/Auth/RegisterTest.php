<?php

namespace Tests\Feature\Web\Auth;

use App\Models\Acl\User;
use App\Services\Web\PhoneService;
use Tests\Feature\BaseFeatureTest;

/**
 * Class RegisterTest
 * @package Tests\Feature\Web\Auth
 */
class RegisterTest extends BaseFeatureTest
{
    /**
     * URL Registration page
     *
     * @var string URL_REGISTER
     */
    protected const URL_REGISTER = '/register';

    /**
     * Check user can view login form
     *
     * @covers \App\Http\Controllers\Web\Auth\RegisterController
     * @test
     * @return void
     */
    public function userCanViewLoinForm() :void
    {
        $response = $this->get(self::URL_REGISTER);
        $response->assertSuccessful();
        $response->assertViewIs('auth.register');
    }

    /**
     * Check user can't registration with incorrect credentials
     *
     * @covers \App\Http\Controllers\Web\Auth\RegisterController
     * @test
     * @return void
     */
    public function failRegistration() :void
    {
        $data_registration = array_merge(
            $this->user_data_registration, [
                'password' => 'incorrect_password',
                'password_confirmation' => self::EXAMPLE_USER_PASSWORD,
                'g-recaptcha-response' => 12345,
                'personalData' => 'agree-personal',
                'siteRules' => 'agree-rules',
            ]
        );

        $this->post(self::URL_REGISTER, $data_registration);

        unset($data_registration['password_confirmation']);
        unset($data_registration['personalData']);
        unset($data_registration['siteRules']);
        unset($data_registration['g-recaptcha-response']);
        $this->assertInvalidCredentials($data_registration);
    }

    /**
     * Check user can registration with correct credentials
     *
     * @covers \App\Http\Controllers\Web\Auth\RegisterController
     * @test
     * @return void
     */
    public function successRegistration() :void
    {
        $data_registration = array_merge(
            $this->user_data_registration, [
                'password' => self::EXAMPLE_USER_PASSWORD,
                'password_confirmation' => self::EXAMPLE_USER_PASSWORD,
                'g-recaptcha-response' => 12345,
                'personalData' => 'agree-personal',
                'siteRules' => 'agree-rules',
            ]
        );

        $response = $this->post(self::URL_REGISTER, $data_registration);
        $response->assertRedirect('/');

        unset($data_registration['password_confirmation']);
        unset($data_registration['personalData']);
        unset($data_registration['siteRules']);
        unset($data_registration['g-recaptcha-response']);

        $phone_service = new PhoneService();
        $data_registration['phone'] = $phone_service->addPrefix($data_registration['phone']);

        $this->assertCredentials($data_registration);

        unset($data_registration['password']);
        $this->assertDatabaseHas((new User())->getTable(), $data_registration);

        $user = User::where('email', self::EXAMPLE_USER_EMAIL)->first();
        $this->assertAuthenticatedAs($user);
    }
}
