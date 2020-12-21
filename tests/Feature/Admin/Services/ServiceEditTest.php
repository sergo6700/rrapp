<?php

namespace Tests\Feature\Admin\Services;

use App\Models\Service\Service;

/**
 * Class ServiceEditTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Service\ServiceCrudController
 * @package Tests\Feature\Admin\Services
 */
class ServiceEditTest extends AbstractServiceTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Service\ServiceCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $service = Service::where($this->service_data)->first();
        $response = $this->get(route('crud.services.edit', ['slug' => $service]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}
