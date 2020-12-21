<?php

use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterColumnsInUsersTable
 */
class AlterColumnsInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table('users', function (Blueprint $table) use($rules) {
            $table->string('email', $rules->email_max)->change();
            $table->string('company_name', $rules->string_max)->change();
            $table->string('social_network', $rules->string_max)->change();
            $table->string('uid_social_network', $rules->string_max)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
