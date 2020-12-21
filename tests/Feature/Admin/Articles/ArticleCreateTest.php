<?php

namespace Tests\Feature\Admin\Articles;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class ArticleCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Post\ArticleCrudController
 * @package Tests\Feature\Admin\Articles
 */
class ArticleCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Post\ArticleCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.article.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}
