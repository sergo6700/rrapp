<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateSlidersTable
 */
class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name')
                ->comment('название слайда (для идентификации)');
            $table->unsignedInteger('sort')
                ->comment('поле сортировки для настройки порядка вывода слайдов');
            $table->text('link')
                ->comment('произвольная ссылка');
            $table->unsignedBigInteger('picture_desktop_id')->nullable()
                ->comment('изображение для десктопа');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('picture_desktop_id')
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
            $table->dropForeign(['picture_desktop_id']);
        });


        Schema::dropIfExists('sliders');
    }
}
