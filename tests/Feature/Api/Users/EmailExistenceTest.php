<?php

namespace Tests\Feature\Api\Users;

use Tests\Feature\BaseFeatureTest;

/**
 * Class EmailExistenceTest
 *
 * @coversDefaultClass \App\Http\Controllers\Api\User\UserController
 * @package Tests\Feature\Api\Users
 */
class EmailExistenceTest extends BaseFeatureTest
{
    /**
     * Nonexistent email
     *
     * @var string ADMIN_EMAIL
     */
    protected const NONEXISTENT_EMAIL = 'nonexistent@nonexistent.com';

    /**
     * Check failed Api request
     *
     * @covers \App\Http\Controllers\Api\User\UserController::emailExistence
     * @test
     * @return void
     */
    public function checkFails() :void
    {
        $response = $this->json('GET', route('users.email.existence', ['email' => self::NONEXISTENT_EMAIL]));
        $response->assertStatus(200)
            ->assertJson([
                'existence' => false
            ]);
    }

    /**
     * Check successful Api request
     *
     * @covers \App\Http\Controllers\Api\User\UserController::emailExistence
     * @test
     * @return void
     */
    public function checkSuccess() :void
    {
        $response = $this->json('GET', route('users.email.existence', ['email' => self::ADMIN_EMAIL]));

        $response->assertStatus(200)
                ->assertJson([
                    'existence' => true
                ]);
    }
}
