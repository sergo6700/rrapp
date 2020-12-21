<?php

namespace Tests\Feature\Web\Services;

/**
 * Class ServiceListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\Services\ServiceController
 * @package Tests\Feature\Web\Services
 */
class ServiceListTest extends AbstractServiceTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\Services\ServiceController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $response = $this->get(route('service'));
        $response->assertStatus(200);
        $response->assertViewIs('web.services.index');
    }
}
