<?php


namespace Tests\Browser\Admin\Pages;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class BackpackDashboard extends Page
{

    /**
     * Get page URL
     *
     * @return string
     */
    public function url()
    {
        return backpack_url('/dashboard');
    }

    /**
     * Default assertion on page
     *
     * @param Browser $browser
     */
    public function assert(Browser $browser)
    {
        $browser->assertUrlIs($this->url());
    }

}
