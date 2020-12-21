<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateEmailsTable
 */
class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
        });

        Schema::create('emailables', function (Blueprint $table) {
            $table->unsignedInteger('email_id');

            $table->morphs('emailable');

            $table->foreign('email_id')
                ->references('id')
                ->on('emails')
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
		Schema::table('emailables', function (Blueprint $table) {
			$table->dropForeign(['email_id']);
		});

		Schema::dropIfExists('emailables');
		Schema::dropIfExists('emails');
    }
}
