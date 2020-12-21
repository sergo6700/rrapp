<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddImageForMobileColumnToSlidersTable
 */
class AddImageForMobileColumnToSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->unsignedBigInteger('picture_mobile_id')
                ->nullable()
                ->after('picture_desktop_id')
                ->comment('изображение для мобилки');

            $table->foreign('picture_mobile_id')
                ->references('id')->on('pictures')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropForeign(['picture_mobile_id']);
            $table->dropColumn('picture_mobile_id');
        });
    }
}
