<?php

use App\Models\Acl\User;
use App\Support\Enum\User\UserRole;
use Illuminate\Database\Migrations\Migration;

class InsertAdminIntoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'email' => 'admin@root.com',
            'name' => 'administrator',
            'password' => bcrypt(config('users.admin.default_password')),
            'role_id' => UserRole::ADMIN,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        User::where('email', 'admin@root.com')->delete();
    }
}
