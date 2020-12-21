<?php

namespace Tests\Feature\Web\Events;

use App\Models\Event\Event;
use Tests\Feature\BaseFeatureTest;

/**
 * Class EventDetailTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Events\EventController
 * @package Tests\Feature\Web\Events
 */
class EventDetailTest extends BaseFeatureTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Events\EventController::show
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $event = Event::where($this->event_data)->first();

        $response = $this->get(route('event.show', ['event' => $event->slug]));
        $response->assertStatus(200);
        $response->assertViewIs('web.events.show');
    }
}
