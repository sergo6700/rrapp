<?php

namespace Tests\Feature\Admin\Events;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class EventCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Event\UpcomingEventCrudController
 * @package Tests\Feature\Admin\Events
 */
class EventCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Event\UpcomingEventCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.upcoming-events.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}
