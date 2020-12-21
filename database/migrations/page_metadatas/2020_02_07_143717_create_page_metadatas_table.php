<?php

use App\Models\PageMetadata\PageMetadata;
use App\Support\Validation\ValidationRules;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreatePageMetadatasTable
 */
class CreatePageMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = (new PageMetadata)->getTable();
        $rules = new ValidationRules();

        Schema::create($name, function (Blueprint $table) use($rules) {
            $table->bigIncrements('id');
            $table->string('page_alias', $rules->string_max)
                ->comment('Псевдоним страницы, для которой будут заполнены мета-теги');
            $table->string('title', $rules->string_max)
                ->comment('Meta title для страницы');
            $table->string('description', $rules->string_max)->default('')->nullable()
                ->comment('Meta description для страницы');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $name = (new PageMetadata)->getTable();
        Schema::dropIfExists($name);
    }
}
