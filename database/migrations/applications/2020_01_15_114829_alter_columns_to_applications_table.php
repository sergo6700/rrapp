<?php

use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterColumnsToApplicationsTable
 */
class AlterColumnsToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table('applications', function (Blueprint $table) use($rules) {
            $table->string('full_name', $rules->string_max)->change();
            $table->string('email', $rules->email_max)->change();
            $table->string('kind_of_activity', $rules->string_max)->change();
            $table->string('company_name', $rules->string_max)->change();
            $table->string('page_title', $rules->string_max)->change();
            $table->text('page_url')->change();
            $table->string('tin', $rules->tin_max)->change();
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
