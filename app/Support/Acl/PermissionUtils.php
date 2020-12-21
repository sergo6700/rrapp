<?php


namespace App\Support\Acl;


use App\Models\Acl\User;
use Illuminate\Support\Facades\Log;

/**
 * Class PermissionUtils
 * @package App\Support\Acl
 */
class PermissionUtils
{
    /**
     * @param User $user
     * @param array $permissions
     * @return bool
     */
    public static function userHasAnyPermission(User $user, array $permissions) : bool {
		foreach ($permissions as $permission) {
			try {
				return $user->hasPermissionTo($permission);
			} catch (\Exception $e) {
				Log::error($e->getMessage());
			}
        }
        return false;
    }
}
