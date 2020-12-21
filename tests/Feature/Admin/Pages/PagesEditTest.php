<?php


namespace Tests\Feature\Admin\Pages;


use App\Models\Pages\Page;

/**
 * Class PagesEditTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Pages\PageCrudController
 * @package Tests\Feature\Admin\Pages
 */
class PagesEditTest extends AbstractPagesTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Pages\PageCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $page = Page::where($this->page_data)->first();
        $response = $this->get(route('crud.page.edit', ['id' => $page->id]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}