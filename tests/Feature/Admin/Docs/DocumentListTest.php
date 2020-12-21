<?php


namespace Tests\Feature\Admin\Docs;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class DocumentListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Docs\DocumentCrudController
 * @package Tests\Feature\Admin\Docs
 */
class DocumentListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Docs\DocumentCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.document.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}