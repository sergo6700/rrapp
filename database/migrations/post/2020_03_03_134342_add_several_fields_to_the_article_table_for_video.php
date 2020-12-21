<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddSeveralFieldsToTheArticleTableForVideo
 */
class AddSeveralFieldsToTheArticleTableForVideo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->boolean('is_video')
                ->after('fixed')
                ->default(false)
                ->comment('Флаг определяющий, что эта сущность принадлежит подкатегории "Видео" раздела "База знаний"');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('is_video');
        });
    }
}
