<?php

namespace Tests\Feature\Admin\News;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class NewsListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Post\NewsCrudController
 * @package Tests\Feature\Admin\News
 */
class NewsListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\NewsCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.news.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}
