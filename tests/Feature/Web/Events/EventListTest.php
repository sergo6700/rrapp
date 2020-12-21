<?php

namespace Tests\Feature\Web\Events;

use Tests\Feature\BaseFeatureTest;

/**
 * Class EventListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Events\EventController
 * @package Tests\Feature\Web\Events
 */
class EventListTest extends BaseFeatureTest
{
    /**
     * Check the http-status of page
     *
     * @covers \App\Http\Controllers\Web\Events\EventController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $response = $this->get(route('event'));

        $response->assertStatus(200);
        $response->assertViewIs('web.events.index');
    }
}