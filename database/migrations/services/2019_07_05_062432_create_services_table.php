<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateServicesTable
 */
class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('Название');
            $table->unsignedSmallInteger('division_id')->nullable()->comment('Организатор');
            $table->text('short_content')->nullable()->comment('Краткое описание');
            $table->text('full_content')->nullable()->comment('Полное описание описание');

            $table->foreign('division_id')
                ->references('id')->on('divisions')
                ->onDelete('set null');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
		Schema::table('services', function (Blueprint $table) {
			$table->dropForeign(['division_id']);
		});

		Schema::dropIfExists('services');
    }
}
