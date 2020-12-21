<?php

use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AlterColumnsInNewsTable
 */
class AlterColumnsInNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table('news', function (Blueprint $table) use($rules) {
            $table->string('title', $rules->string_max)->change();
            $table->string('slug', $rules->string_max)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
