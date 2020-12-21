<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddNewFieldsToApplicationsServiceTable
 */
class AddNewFieldsToApplicationsServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('applications_service', 'applications');
        Schema::table('applications', function (Blueprint $table) {
            $table->string('page_url')->after('service_id')->nullable()
                ->comment('Страница отправки (страница, с которой была отправлена заявка');
            $table->string('full_name')->after('page_url')->nullable()
                ->comment('ФИО');
            $table->string('email')->after('full_name')->nullable()
                ->comment('Email');
            $table->string('phone')->after('email')->nullable()
                ->comment('Телефон');
            $table->string('tin')->after('phone')->nullable()
                ->comment('ИНН');
            $table->string('company_name')->after('tin')->nullable()
                ->comment('Наименование компании');
            $table->string('kind_of_activity')->after('company_name')->nullable()
                ->comment('Вид деятельности');
            $table->string('subject')->after('kind_of_activity')->nullable()
                ->comment('Тема обращения');
            $table->tinyInteger('type_id')->after('subject')->comment('Тип заявки');
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->unsignedInteger('service_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('page_url');
            $table->dropColumn('full_name');
            $table->dropColumn('phone');
            $table->dropColumn('tin');
            $table->dropColumn('company_name');
            $table->dropColumn('kind_of_activity');
            $table->dropColumn('subject');
            $table->dropColumn('type_id');
        });
        
		Schema::rename('applications', 'applications_service');
    }
}
