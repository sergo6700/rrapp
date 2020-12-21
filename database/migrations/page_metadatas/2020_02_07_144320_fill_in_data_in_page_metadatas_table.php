<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use App\Models\PageMetadata\PageMetadata;

/**
 * Class FillInDataInPageMetadatasTable
 */
class FillInDataInPageMetadatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = [
            [
                'page_alias' => PageMetadata::MAIN_ALIAS,
                'title' => 'Мой Бизнес',
            ],
            [
                'page_alias' => PageMetadata::SERVICES_ALIAS,
                'title' => 'Сервисы',
            ],
            [
                'page_alias' => PageMetadata::ARTICLES_ALIAS,
                'title' => 'Статьи',
            ],
            [
                'page_alias' => PageMetadata::NEWS_ALIAS,
                'title' => 'Новости',
            ],
            [
                'page_alias' => PageMetadata::DEPARTMENTS_ALIAS,
                'title' => 'Подразделения',
            ],
            [
                'page_alias' => PageMetadata::DOCS_ALIAS,
                'title' => 'Нормативные документы',
            ],
            [
                'page_alias' => PageMetadata::UPCOMING_EVENTS_ALIAS,
                'title' => 'Будущие мероприятия',
            ],
            [
                'page_alias' => PageMetadata::PAST_EVENTS_ALIAS,
                'title' => 'Прошедшие мероприятия',
            ],
            [
                'page_alias' => PageMetadata::MEDIA_ALIAS,
                'title' => 'СМИ о нас',
            ],
        ];

        PageMetadata::insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $name = (new PageMetadata)->getTable();
        if (Schema::hasTable($name)) {
            DB::table($name)->truncate();
        }
    }
}
