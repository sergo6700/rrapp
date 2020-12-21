<?php

namespace Tests\Feature\Web;

use Tests\Feature\BaseFeatureTest;

/**
 * Class MainPageTest
 *
 * @package Tests\Feature\Web
 */
class MainPageTest extends BaseFeatureTest
{
    /**
     * Check http status code
     *
     * @covers \App\Http\Controllers\Web\Main\MainController::index
     * @test
     * @return void
     */
    public function checkStatus() :void
    {
        $response = $this->get(route('main.page'));

        $response->assertStatus(200);
    }
}
