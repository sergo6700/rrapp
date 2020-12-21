<?php

use App\Models\Event\Event;
use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddDescriptionColumnToEventsTable
 */
class AddDescriptionColumnToEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table((new Event)->getTable(), function (Blueprint $table) use ($rules) {
            $table->string('description', $rules->string_max)->default('')
                ->nullable()
                ->after('slug')
                ->comment('Meta description для страницы');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table((new Event)->getTable(), function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
