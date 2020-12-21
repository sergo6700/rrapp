<?php

use Illuminate\Database\Migrations\Migration;
use Backpack\PermissionManager\app\Models\Role;
use Backpack\PermissionManager\app\Models\Permission;

/**
 * Class SetUpBasePermissions
 */
class SetUpBasePermissions extends Migration
{
    /**
     * @var array Базовые права для групп пользоватлелей
     */
    protected $basePermissions = [
        'Пользователь'  => [],
        'Модератор'     => [
            'admin_dashboard',
            'admin_news',
            'admin_article',
            'admin_page',
            'admin_page_template',
        ],
        'Администратор' => [
            'admin_dashboard',
            'admin_news',
            'admin_article',
            'admin_page',
            'admin_page_template',
            'admin_settings',
            'admin_users',
            'admin_roles',
            'admin_permissions'
        ]
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach ($this->basePermissions as $roleName => $permissions) {
            $role = Role::findByName($roleName);
            foreach ($permissions as $permissionName) {
                $permission = Permission::firstOrCreate([
                    'name' =>  $permissionName,
                    'guard_name' => 'web'
                ]);

                $role->givePermissionTo($permission->name);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->basePermissions as $roleName => $permissions) {
            $role = Role::findByName($roleName);
            foreach ($permissions as $permissionName) {
                $permission = Permission::where('name', $permissionName)->first();
                if (!$permission) {
                    continue;
                }
                $role->revokePermissionTo($permission->name);
                $permission->delete();
            }
        }
    }
}
