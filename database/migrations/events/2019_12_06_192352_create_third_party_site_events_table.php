<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Event\AccessToEventsData;

/**
 * Class CreateThirdPartySiteEventsTable
 */
class CreateThirdPartySiteEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('third_party_site_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('event_id')->comment('Id мероприятия');
            $table->string('hash')->comment('Часть URL. Hash для проверки секретной ссылки из сторонних сайтов при регистрации пользователей');

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('event_id')
                ->references('id')->on('events')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('third_party_site_events')) {
            Schema::table('third_party_site_events', function (Blueprint $table) {
                $table->dropForeign('third_party_site_events_event_id_foreign');
            });

            Schema::dropIfExists('third_party_site_events');
        }
    }
}
