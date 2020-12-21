<?php

use App\Models\PageMetadata\PageMetadata;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class MakeThePageAliasColumnUniqueInPageMetadatasTable
 */
class MakeThePageAliasColumnUniqueInPageMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = (new PageMetadata)->getTable();
        Schema::table($name, function (Blueprint $table) {
            $table->unique('page_alias')->change();
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
        Schema::table($name, function (Blueprint $table) {
            $table->dropUnique('page_metadatas_page_alias_unique');
        });
    }
}
