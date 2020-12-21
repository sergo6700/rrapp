<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateArticlesTable
 */
class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('Название');
            $table->string('slug')->default('')->comment('Slug (URL)');
            $table->text('content')->comment('Контент');
            $table->unsignedBigInteger('picture_id')->nullable()->comment('Изображение');
            $table->unsignedTinyInteger('visibility_type_id')->default(0)->comment('Видимость');
            $table->date('date')->comment('Дата публикации');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('picture_id')
                ->references('id')->on('pictures')
                ->onDelete('set null');
        });

        DB::unprepared("ALTER TABLE articles COMMENT = 'Статьи';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['picture_id']);
        });
        Schema::drop('articles');
    }
}
