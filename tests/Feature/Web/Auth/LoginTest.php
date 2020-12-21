<?php

namespace Tests\Feature\Web\Auth;

use App\Models\Acl\User;
use Tests\Feature\BaseFeatureTest;

/**
 * Class LoginTest
 * @package Tests\Feature\Web\Auth
 */
class LoginTest extends BaseFeatureTest
{
    /**
     * URL Login page
     *
     * @var string URL_LOGIN
     */
    protected const URL_LOGIN = '/login';

    /**
     * Check user can view login form
     *
     * @covers \App\Http\Controllers\Web\Auth\LoginController
     * @test
     * @return void
     */
    public function userCanViewLoinForm() :void
    {
        $response = $this->get(self::URL_LOGIN);
        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    /**
     * Check user can't login with incorrect credentials
     *
     * @covers \App\Http\Controllers\Web\Auth\LoginController
     * @test
     * @return void
     */
    public function failLogin() :void
    {
        $this->setAuthenticatedUser();
        $user = User::where('email', self::EXAMPLE_USER_EMAIL)->get()[0];

        $data = [
            'email' => $user->email,
            'password' => 'incorrect_password',
        ];

        $this->post(self::URL_LOGIN, $data);

        $this->assertInvalidCredentials($data);
    }

    /**
     * Check user can login with correct credentials
     *
     * @covers \App\Http\Controllers\Web\Auth\LoginController
     * @test
     * @return void
     */
    public function successLogin() :void
    {
        $this->setAuthenticatedUser();
        $user = User::where('email', self::EXAMPLE_USER_EMAIL)->get()[0];

        $response = $this->post(self::URL_LOGIN, [
            'email' => $user->email,
            'password' => self::EXAMPLE_USER_PASSWORD,
            'remember' => 'on',
        ]);

        $response->assertRedirect('/');

        // cookie assertion goes here
        $this->assertAuthenticatedAs($user);
    }
}
