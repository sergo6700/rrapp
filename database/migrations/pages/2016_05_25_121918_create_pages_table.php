<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: use JSON data type for 'extras' instead of string
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedSmallInteger('template_id')->comment('ID шаблона');
            $table->string('title')->comment('Название страницы');
            $table->string('slug')->comment('Slug (URL)');
            $table->text('content')->nullable()->comment('Контент страницы');
            $table->text('extras')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('template_id')
                ->references('id')->on('page_templates');
        });

        DB::unprepared("ALTER TABLE pages COMMENT = 'Страницы сайта';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
