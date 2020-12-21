<?php

use App\Models\Acl\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class RoleInCompanyNullable
 */
class RoleInCompanyNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('users', function (Blueprint $table) {
			$table->integer('role_in_company_id')->nullable()->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	User::whereNull('role_in_company_id')->each(function ($item) {
    		$item->delete();
		});

        Schema::table('users', function (Blueprint $table) {
			$table->integer('role_in_company_id')->nullable(false)->change();
        });
    }
}
