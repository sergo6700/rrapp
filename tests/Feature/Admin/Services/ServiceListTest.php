<?php

namespace Tests\Feature\Admin\Services;

/**
 * Class ServiceListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Service\ServiceCrudController
 * @package Tests\Feature\Admin\Services
 */
class ServiceListTest extends AbstractServiceTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Service\ServiceCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.services.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}
