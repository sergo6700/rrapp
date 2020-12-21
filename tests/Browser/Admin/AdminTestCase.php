<?php
namespace Tests\Browser\Admin;

use App\Models\Acl\User;
use Tests\DuskTestCase;

class AdminTestCase extends DuskTestCase
{

    /**
     * If true, setup has run at least once.
     * @var boolean
     */
    protected static $runOnce = false;

    /**
     * @var string
     */
    protected $backpack_url;

    /**
     * @var User
     */
    protected $user;

    /**
     * @var User
     */
    protected $admin;

    /**
     * @var User
     */
    protected $moderator;

    /**
     * set up
     */
    public function setUp(): void
    {
        parent::setUp();

        if (!static::$runOnce) {
            $this->artisan('migrate:fresh --seed');

            static::$runOnce = true;
        }

        $this->setupUsers();
    }

    /**
     * Setup admin users
     *
     * @rerurn void
     */
    protected function setupUsers()
    {
        $this->admin = factory(User::class)->state('admin')->create();
        $this->moderator = factory(User::class)->state('moderator')->create();
        $this->user = factory(User::class)->state('user')->create();
    }

}
