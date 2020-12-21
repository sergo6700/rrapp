<?php

namespace Tests\Feature\Admin\Media;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class MediaCreateTest
 * @coversDefaultClass \App\Http\Controllers\Admin\Media\MediaCrudController
 * @package Tests\Feature\Admin\Media
 */
class MediaCreateTest extends AdminLoginTest
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

        $response = $this->get(route('crud.media.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}
