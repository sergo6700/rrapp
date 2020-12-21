<?php


namespace Tests\Browser\Admin\Pages\PageTemplate;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class BackpackPageTemplateCreate extends Page
{

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return backpack_url('/page-template/create');
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
            '@create_form' => '.content form',
        ];
    }

    /**
     * Submit form
     *
     * @param Browser $browser
     */
    public function submitCreateForm(Browser $browser)
    {
        $browser->with('@create_form', function (Browser $brws) {
            $brws
                ->type('name', 'TEMPLATE_NAME')
                ->select('template', 0)
                ->type('class_name', '.test-classname')
                ->type('styles', '
                    .test-classname { 
                        background-color: #ff0000; 
                    } 
                    .test-classname h2 {
                        font-size: 40px
                    }
                ')
                ->click('@submit');
        });
    }

}
