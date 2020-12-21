<?php

use App\Models\PageMetadata\PageMetadata;
use Illuminate\Database\Migrations\Migration;

/**
 * Class AddMetadatasAboutProfilePageInPageMetadatasTable
 */
class AddMetadatasAboutProfilePageInPageMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PageMetadata::insert([
            [
                'page_alias' => PageMetadata::PROFILE_ALIAS,
                'title' => 'Личный кабинет',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $pageMetadata = PageMetadata::where('page_alias', PageMetadata::PROFILE_ALIAS)->first();
        $pageMetadata->delete();
    }
}
