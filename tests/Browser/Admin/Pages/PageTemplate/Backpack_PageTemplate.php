<?php


namespace Tests\Browser\Admin\Pages\PageTemplate;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class BackpackPageTemplate extends Page
{

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return backpack_url('/page-template');
    }

    /**
     * Assert that the browser is on the page.
     *
     * @param  \Laravel\Dusk\Browser  $browser
     * @return void
     */
    public function assert(Browser $browser)
    {
        $browser->assertUrlIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array
     */
    public function elements()
    {
        return [];
    }

    /**
     * Кнопка "Добавить"
     *
     * @param Browser $browser
     */
    public function assertSeeAddButton(Browser $browser)
    {
        $browser->assertSeeIn('span', trans('backpack::crud.add'));
        $browser->assertSee(trans('backpack::crud.add'));
    }

}
