<?php

use App\Models\Event\Event;
use Illuminate\Database\Migrations\Migration;
use App\Models\Event\AccessToEventsData;
use App\Services\Admin\AccessToEventsDataService;

/**
 * Class FillThirdPartySiteEventsTable
 */
class FillThirdPartySiteEventsTable extends Migration
{
    /**
     * AccessToEventsDataService
     *
     * @var AccessToEventsDataService model
     */
    protected $thirdPartySiteEventsService;

    /**
     * FillThirdPartySiteEventsTable constructor.
     */
    public function __construct()
    {
        $this->thirdPartySiteEventsService = new AccessToEventsDataService();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $thirdPartySiteEvents = DB::table('third_party_site_events')
            ->where('deleted_at', NULL)
            ->get('event_id');
        $exceptEventIds_arr = $thirdPartySiteEvents->pluck('event_id')->toArray();

        $events = Event::select()->whereNotIn('id', $exceptEventIds_arr)->get();
        foreach ($events as $event) {
            $this->thirdPartySiteEventsService->create($event);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('third_party_site_events')) {
            DB::table('third_party_site_events')->truncate();
        }
    }
}
