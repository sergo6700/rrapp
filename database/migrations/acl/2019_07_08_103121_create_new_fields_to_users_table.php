<?php

use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateNewFieldsToUsersTable
 */
class CreateNewFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('users', function($table) {
            $table->string('surname')->after('name')->comment('Отчество');
            $table->string('last_name')->after('surname')->comment('Фамилия');
            $table->string('phone')->after('email')->comment('Телефон');
            $table->string('tin')->after('phone')->comment('ИНН');
            $table->string('company_name')->after('tin')->comment('Наименование компании');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function($table) {
            $table->dropColumn('surname');
            $table->dropColumn('last_name');
            $table->dropColumn('phone');
            $table->dropColumn('tin');
            $table->dropColumn('company_name');
        });
    }
}
