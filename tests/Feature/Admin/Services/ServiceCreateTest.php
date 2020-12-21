<?php

namespace Tests\Feature\Admin\Services;

/**
 * Class ServiceCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Service\ServiceCrudController
 * @package Tests\Feature\Admin\Services
 */
class ServiceCreateTest extends AbstractServiceTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Service\ServiceCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.services.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}
