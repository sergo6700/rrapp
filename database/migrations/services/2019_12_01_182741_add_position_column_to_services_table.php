<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddPositionColumnToServicesTable
 */
class AddPositionColumnToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('services', 'position')) {
            Schema::table('services', function (Blueprint $table) {
                $table->unsignedInteger('position')
                    ->default(0)
                    ->after('is_show_on_main')
                    ->comment('Позиция на странице');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'position')) {
                $table->dropColumn('position');
            }
        });
    }
}
