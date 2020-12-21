<?php

namespace Tests\Feature\Admin\Media;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class MediaListTest
 * @coversDefaultClass \App\Http\Controllers\Admin\Media\MediaCrudController
 * @package Tests\Feature\Admin\Media
 */
class MediaListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Media\MediaCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.media.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}
