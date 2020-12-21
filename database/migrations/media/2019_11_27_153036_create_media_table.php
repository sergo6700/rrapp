<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateMediaTable
 */
class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('media')) {
            Schema::create('media', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->text('description')->comment('Описание');
                $table->unsignedBigInteger('picture_id')->nullable()->comment('Изображение');
                $table->text('link')->comment('Ссылка на сторонний сайт');
                $table->timestamps();

                $table->softDeletes();

                $table->foreign('picture_id')
                    ->references('id')->on('pictures')
                    ->onDelete('set null');
            });

            DB::unprepared("ALTER TABLE media COMMENT = 'СМИ О Нас';");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('media')) {
            Schema::table('media', function (Blueprint $table) {
                $table->dropForeign(['picture_id']);
            });
        }

        Schema::dropIfExists('media');
    }
}
