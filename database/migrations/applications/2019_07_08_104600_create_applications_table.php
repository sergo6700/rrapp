<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateApplicationsTable
 */
class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('applications_service', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('service_id');
            $table->text('content')->comment('Сопровождающий текст');
            $table->boolean('is_completed')->default(0)
                ->comment('Отметка о завершении работ по заявке');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('service_id')
                ->references('id')
                ->on('services')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
		Schema::table('applications_service', function (Blueprint $table) {
			$table->dropForeign(['user_id']);
			$table->dropForeign(['service_id']);
		});

        Schema::dropIfExists('applications_service');
    }
}
