<?php
namespace Tests\Browser\Admin\Tests\Dashboard;

use Laravel\Dusk\Browser;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Admin\Components\Menu\BPMenu;
use Tests\Browser\Admin\Pages\BackpackDashboard;

class BackpackMenuRoleAdminTest extends AdminTestCase
{

    /**
     * test admin menu for user role 'admin'
     *
     * @throws \Throwable
     */
    public function testAdminMenuForRoleAdmin()
    {
        $this->browse(function(Browser $browser) {
            $browser
                ->loginAs($this->admin, 'backpack')
                ->visit(new BackpackDashboard())
                ->within(new BPMenu('admin'), function(Browser $brws) {
                    $brws->checkMenu();
                })
                ->logout('backpack');

        });
    }

}
