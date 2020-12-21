<?php

use Illuminate\Database\Migrations\Migration;
use Backpack\PermissionManager\app\Models\Role;
use App\Support\Enum\User\UserRole;
use Backpack\PermissionManager\app\Models\Permission;

/**
 * Class AlterPermissionsAddAdminDocumentPermission
 */
class AlterPermissionsAddAdminDocumentPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = Permission::create([
            'name' => 'admin_documents',
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
        $permission = Permission::findByName('admin_documents');
        Role::findByName(UserRole::getValue(UserRole::ADMIN))->revokePermissionTo($permission->name);
        Role::findByName(UserRole::getValue(UserRole::MODERATOR))->revokePermissionTo($permission->name);
        $permission->delete();
    }
}
