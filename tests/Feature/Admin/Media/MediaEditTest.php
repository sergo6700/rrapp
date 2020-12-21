<?php

namespace Tests\Feature\Admin\Media;

use App\Models\Media\Media;

/**
 * Class MediaEditTest
 * @coversDefaultClass \App\Http\Controllers\Admin\Media\MediaCrudController
 * @package Tests\Feature\Admin\Media
 */
class MediaEditTest extends AbstractMediaTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Media\MediaCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $media = Media::where($this->media_data)->first();
        $response = $this->get(route('crud.media.edit', ['id' => $media->id]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}
