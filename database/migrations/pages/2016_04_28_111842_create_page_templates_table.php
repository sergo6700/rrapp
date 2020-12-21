<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_templates', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('name')->comment('Название');
            $table->string('template')->comment('Шаблон blade');
            $table->string('class_name')->nullbale()->comment('Название базового CSS класса');
            $table->longText('styles')->nullable()->comment('Стили CSS');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::unprepared("ALTER TABLE page_templates COMMENT = 'Шаблоны страниц';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_templates');
    }
}
