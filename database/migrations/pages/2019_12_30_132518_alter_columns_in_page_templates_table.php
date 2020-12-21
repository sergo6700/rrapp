<?php

use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterColumnsInPageTemplatesTable
 */
class AlterColumnsInPageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table('page_templates', function (Blueprint $table) use($rules) {
            $table->string('name', $rules->string_max)->change();
            $table->string('template', $rules->string_max)->change();
            $table->string('class_name', $rules->string_max)->change();
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
