<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddPositionColumnToDivisionsTable
 */
class AddPositionColumnToDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('divisions', 'position')) {
            Schema::table('divisions', function (Blueprint $table) {
                $table->unsignedInteger('position')
                    ->default(0)
                    ->after('content')
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
        Schema::table('divisions', function (Blueprint $table) {
            if (Schema::hasColumn('divisions', 'position')) {
                $table->dropColumn('position');
            }
        });
    }
}
