<?php


namespace Tests\Feature\Admin\Elfinder;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class ElfinderTest
 *
 * @coversDefaultClass \Barryvdh\Elfinder\ElfinderController
 *
 * @package Tests\Feature\Admin\Elfinder
 */
class ElfinderTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \Barryvdh\Elfinder\ElfinderController::showIndex
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();
        $response = $this->get(route('elfinder.index'));
        $response->assertOk();
    }
}