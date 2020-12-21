<?php

namespace Tests\Feature\Web\News;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class NewsListFiltersTest
 *
 * @coversDefaultClass \App\Http\Controllers\Web\News\NewsController
 * @package Tests\Feature\Web\News
 */
class NewsListFiltersTest extends AbstractNewsTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Web\News\NewsController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        // filter with only a year
        $year = date('Y');
        $response = $this->get(route('news', ['year' => $year]));
        $response->assertStatus(200)
                ->assertViewIs('web.news.index');

        // filter with only a month
        $month = date('n');
        $response = $this->get(route('news', ['month' => $month]));
        $response->assertStatus(200)
            ->assertViewIs('web.news.index');

        // filter with month and year
        $response = $this->get(route('news', ['month' => $month, 'year' => $year]));
        $response->assertStatus(200)
            ->assertViewIs('web.news.index');
    }
}
