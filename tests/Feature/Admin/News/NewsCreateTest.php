<?php

namespace Tests\Feature\Admin\News;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class NewsCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Post\NewsCrudController
 * @package Tests\Feature\Admin\News
 */
class NewsCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\NewsCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.news.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}
