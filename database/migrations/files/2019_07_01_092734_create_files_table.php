<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateFilesTable
 */
class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('url')->comment('URL Ссылка на файл');
            $table->string('path')->comment('Путь файла на сервере');
            $table->string('filename')->comment('Имя файла');
            $table->string('original_name')->nullable()->comment('Оригинальное имя файла');
            $table->string('mimetype')->nullable()->comment('Mimetype файла');
            $table->integer('size')->nullable()->comment('Размер файла');
            $table->timestamps();

            $table->unique('path');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('files');
    }
}
