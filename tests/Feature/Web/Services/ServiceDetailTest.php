<?php

namespace Tests\Feature\Web\Services;

use App\Models\Service\Service;

/**
 * Class ServiceDetailTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Services\ServiceController
 * @package Tests\Feature\Web\Services
 */
class ServiceDetailTest extends AbstractServiceTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Events\EventController::show
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening()
    {
        $service = Service::where($this->service_data)->first();

        $response = $this->get(
            route('service.show', ['slug' => $service->slug])
        );

        $response->assertStatus(200);
        $response->assertViewIs('web.services.show');
    }
}
