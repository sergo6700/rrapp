<?php


namespace Tests\Feature\Admin\Pages;


use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class PagesListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Pages\PageCrudController
 * @package Tests\Feature\Admin\Pages
 *
 */
class PagesListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Pages\PageCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.page.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}