<?php

namespace Tests\Feature\Admin\Events;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class EventListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Event\UpcomingEventCrudController
 * @package Tests\Feature\Admin\Events
 */
class EventListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Event\UpcomingEventCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.upcoming-events.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}
