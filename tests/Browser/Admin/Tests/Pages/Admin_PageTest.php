<?php
namespace Tests\Browser\Admin\Tests\Pages;

use Laravel\Dusk\Browser;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Admin\Pages\Page\BackpackPage;

class AdminPageTest extends AdminTestCase
{

    /**
     * test Route('/admin/page')
     *
     * @throws \Throwable
     */
    public function testPageList()
    {
        $this->browse(function(Browser $browser) {
            $browser
                ->loginAs($this->admin, 'backpack')
                ->loginAs($this->admin, 'web')
                ->visit(new BackpackPage());
        });
    }

}
