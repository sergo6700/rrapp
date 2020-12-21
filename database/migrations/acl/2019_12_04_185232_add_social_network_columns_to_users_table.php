<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddSocialNetworkColumnsToUsersTable
 */
class AddSocialNetworkColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uid_social_network', 100)
                ->after('email_verified_at')
                ->comment('Уникальный идентификатор пользователя из соц.сетей');

            $table->string('social_network')
                ->after('uid_social_network')
                ->comment('Через какую соц.сеть зарегистрировался пользователь');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uid_social_network');
            $table->dropColumn('social_network');
        });
    }
}
