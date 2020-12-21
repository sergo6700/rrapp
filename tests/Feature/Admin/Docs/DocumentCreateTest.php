<?php


namespace Tests\Feature\Admin\Docs;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class DocumentCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Docs\DocumentCrudController
 * @package Tests\Feature\Admin\Docs
 */
class DocumentCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Docs\DocumentCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.document.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}