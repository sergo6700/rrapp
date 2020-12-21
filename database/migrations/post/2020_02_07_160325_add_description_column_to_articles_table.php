<?php

use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Post\Article;

/**
 * Class AddDescriptionColumnToArticlesTable
 */
class AddDescriptionColumnToArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rules = new ValidationRules();

        Schema::table((new Article)->getTable(), function (Blueprint $table) use ($rules) {
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
        Schema::table((new Article)->getTable(), function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
}
