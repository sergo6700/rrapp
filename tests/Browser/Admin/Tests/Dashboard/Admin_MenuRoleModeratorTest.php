<?php
namespace Tests\Browser\Admin\Tests\Dashboard;

use Laravel\Dusk\Browser;
use Tests\Browser\Admin\AdminTestCase;
use Tests\Browser\Admin\Components\Menu\BPMenu;
use Tests\Browser\Admin\Pages\BackpackDashboard;

class AdminMenuRoleModeratorTest extends AdminTestCase
{

    /**
     * test admin menu for user role 'moderator'
     *
     * @throws \Throwable
     */
    public function testAdminMenuForRoleModerator()
    {
        $this->browse(function(Browser $browser) {
            $browser
                ->loginAs($this->moderator, 'backpack')
                ->visit(new BackpackDashboard())
                ->within(new BPMenu('moderator'), function(Browser $brws) {
                    $brws->checkMenu();
                });

        });
    }


}
