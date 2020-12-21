<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Backpack\PermissionManager\app\Models\Role;
use App\Models\Acl\User;
use App\Support\Enum\User\UserRole;

/**
 * Class SetUpBaseRoles
 */
class SetUpBaseRoles extends Migration
{
    /**
     * @var array
     */
    private $roles = ['Пользователь', 'Модератор', 'Администратор'];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->roles as $role) {
            Role::create([
                'name'       => $role,
                'guard_name' => 'web'
            ]);
        }
        $admin = User::where('email', 'admin@root.com')->first();
        if ($admin) {
            $admin->assignRole(UserRole::getValue(UserRole::ADMIN));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $admin = User::where('email', 'admin@root.com')->first();
        if ($admin) {
            $admin->removeRole(UserRole::getValue(UserRole::ADMIN));
        }
        Role::whereIn('name', $this->roles)->delete();
    }
}
