<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEventsTable
 */
class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->comment('Название');
            $table->string('slug')->default('')->comment('Slug (URL)');
            $table->datetime('date')->comment('Дата и время проведения');
            $table->unsignedSmallInteger('division_id')->nullable()->comment('Организатор');
            $table->unsignedInteger('address_id')->nullable()->comment('Место проведения');
            $table->integer('visitors_count')->nullable()
                ->comment('Максимальное количество участников');
            $table->unsignedBigInteger('report_file_id')->nullable();
            $table->text('short_content')->comment('Краткое описание');
            $table->text('full_content')->comment('Полное описание описание');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->onDelete('set null');
            $table->foreign('address_id')
                ->references('id')->on('addresses')
                ->onDelete('set null');
            $table->foreign('report_file_id')
                ->references('id')->on('files')
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['division_id']);
            $table->dropForeign(['address_id']);
            $table->dropForeign(['report_file_id']);
        });

        Schema::dropIfExists('events');
    }
}
