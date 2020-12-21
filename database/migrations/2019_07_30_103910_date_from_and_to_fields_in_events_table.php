<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class DateFromAndToFieldsInEventsTable
 */
class DateFromAndToFieldsInEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
			$table->dateTime('date')->nullable()->change();
			$table->renameColumn('date', 'date_from');
            $table->dateTime('date_to')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
			$table->dropColumn('date_to');
			$table->dateTime('date_from')->nullable(false)->change();
			$table->renameColumn('date_from', 'date');
        });
    }
}
