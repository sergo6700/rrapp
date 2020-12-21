<?php

namespace Tests\Feature\Admin;

use Tests\Feature\BaseFeatureTest;

/**
 * Class AdminLoginTest
 *
 * @coversDefaultClass \Backpack\Base\app\Http\Controllers\Auth\LoginController
 * @package Tests\Feature\Admin
 */
class AdminLoginTest extends BaseFeatureTest
{
    /**
     * Check successful page opening
     *
     * @covers \Backpack\Base\app\Http\Controllers\Auth\LoginController::showLoginForm
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $response = $this->get(route('backpack.auth.login'));

        $response->assertOk();
        $response->assertViewIs('backpack::auth.login');
    }

    /**
     * Successfully Log in to the admin panel
     *
     * @covers \Backpack\Base\app\Http\Controllers\Auth\LoginController::login
     * @test
     * @return void
     */
    public function successLogIn() :void
    {
        $data = [
            'email' => self::ADMIN_EMAIL,
            'password' => config('users.admin.default_password'),
        ];

        $response = $this->post('/admin/login', $data);

        $response->assertRedirect('admin/dashboard');
        $this->assertCredentials($data);
    }


    /**
     * Failed to login to admin panel
     *
     * @covers \Backpack\Base\app\Http\Controllers\Auth\LoginController::login
     * @test
     * @return void
     */
    public function failedLogIn() :void
    {
        $data = [
            'email' => self::ADMIN_EMAIL,
            'password' => 'invalid_password',
        ];

        $this->post('/admin/login', $data);
        $this->assertInvalidCredentials($data);
    }
}
