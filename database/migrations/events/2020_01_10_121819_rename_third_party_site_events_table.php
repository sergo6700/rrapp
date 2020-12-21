<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use App\Models\Event\AccessToEventsData;

/**
 * Class RenameThirdPartySiteEventsTable
 */
class RenameThirdPartySiteEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('third_party_site_events')) {
            Schema::rename('third_party_site_events', (new AccessToEventsData)->getTable());
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable((new AccessToEventsData)->getTable())) {
            Schema::rename((new AccessToEventsData)->getTable(), 'third_party_site_events');
        }
    }
}
