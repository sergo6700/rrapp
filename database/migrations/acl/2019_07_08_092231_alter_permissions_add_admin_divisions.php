<?php

use App\Support\Enum\User\UserRole;
use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterPermissionsAddAdminDivisions
 */
class AlterPermissionsAddAdminDivisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = Permission::create([
            'name' => 'admin_divisions',
            'guard_name' => 'web'
        ]);
        Role::findByName(UserRole::getValue(UserRole::ADMIN))->givePermissionTo($permission->name);
        Role::findByName(UserRole::getValue(UserRole::MODERATOR))->givePermissionTo($permission->name);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $permission = Permission::findByName('admin_divisions');
        Role::findByName(UserRole::getValue(UserRole::ADMIN))->revokePermissionTo($permission->name);
        Role::findByName(UserRole::getValue(UserRole::MODERATOR))->revokePermissionTo($permission->name);
        $permission->delete();
    }
}
