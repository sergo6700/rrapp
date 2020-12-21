<?php
namespace Tests\Browser\Admin\Pages\Page;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class BackpackPageEdit extends Page
{

    /**
     * @var int
     */
    protected $id;

    /**
     * AdminPageTemplateEdit constructor.
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return backpack_url("/page/{$this->id}/edit");
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
        return parent::elements();
    }

}
