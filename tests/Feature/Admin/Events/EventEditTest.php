<?php

namespace Tests\Feature\Admin\Events;

use App\Models\Event\Event;
use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class EventEditTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Event\UpcomingEventCrudController
 * @package Tests\Feature\Admin\Events
 */
class EventEditTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Event\UpcomingEventCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $event = Event::where($this->event_data)->first();
        $response = $this->get(route('crud.upcoming-events.edit', ['event' => $event->slug]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}
