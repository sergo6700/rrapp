<?php

use App\Support\Enum\User\UserRole;
use Backpack\PermissionManager\app\Models\Permission;
use Backpack\PermissionManager\app\Models\Role;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddAdminSliderToPermissionsTable
 */
class AddAdminSliderToPermissionsTable extends Migration
{
    private $data = [
        'name' => 'admin_slider',
        'guard_name' => 'web'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = Permission::create($this->data);
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
		$permission = Permission::findByName($this->data['name']);
        Role::findByName(UserRole::getValue(UserRole::ADMIN))->revokePermissionTo($permission->name);
		Role::findByName(UserRole::getValue(UserRole::MODERATOR))->revokePermissionTo($permission->name);
        $permission->delete();
    }
}
