<?php


namespace Tests\Feature\Admin\Pages;


use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class PagesCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Pages\PageCrudController
 * @package Tests\Feature\Admin\Pages
 */
class PagesCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Pages\PageCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.page.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}