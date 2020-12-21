<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Support\Validation\ValidationRules;

/**
 * Class AlterColumnsInEventsTable
 */
class AlterColumnsInEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table('events', function (Blueprint $table) use($rules) {
            $table->string('title', $rules->string_max)->change();
            $table->string('slug', $rules->string_max)->change();
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
