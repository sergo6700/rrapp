<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomRoleFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('custom_role')->after('tin')->comment('Другая роль')->nullable();
        });

        $other_users = \App\Models\Acl\User::where('role_in_company_id', '=', 3)->get();
        foreach ($other_users as $user) {
            $user->custom_role = $user->tin;
            $user->tin = null;
            $user->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $other_users = \App\Models\Acl\User::where('role_in_company_id', '=', 3)->get();
        foreach ($other_users as $user) {
            $user->tin = $user->custom_role;
            $user->save();
        }

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('custom_role');
        });
    }
}
