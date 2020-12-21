<?php


namespace Tests\Browser\Admin\Pages\PageTemplate;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class BackpackPageTemplateEdit extends Page
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
        return backpack_url("/page-template/{$this->id}/edit");
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
        return [
            '@submit' => '#saveActions button[type=submit]',
        ];
    }

    /**
     * Submit form
     *
     * @param Browser $browser
     */
    public function submitEditForm(Browser $browser)
    {
        $browser
            ->type('name', 'EDITABLE_TEMPLATE_NAME')
            ->select('template', 0)
            ->type('class_name', '.edit-test-classname')
            ->type('styles', '
                .edit-test-classname { 
                    background-color: #ff0000; 
                } 
                .edit-test-classname h2 {
                    font-size: 40px
                }
            ')
            ->click('@submit');
    }

}
