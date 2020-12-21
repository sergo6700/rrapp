<?php


namespace App\Services\Admin;

use App\Models\Event\AccessToEventsData;
use App\Support\Hash\HashHelper;
use Illuminate\Support\Facades\Hash;

/**
 * Class AccessToEventsDataService
 * @package App\Services\Admin
 */
class AccessToEventsDataService
{
    /**
     * Create AccessToEventsData
     *
     * @param $event
     */
    public function create($event) :void
    {
        AccessToEventsData::create([
            'event_id' => $event->id,
            'hash' => Hash::make($event->id . time())
        ]);
    }

    /**
     * Generating URLs
     *
     * @param AccessToEventsData $thirdPartySiteEvents
     * @return string
     */
    public function generatingURL(AccessToEventsData $thirdPartySiteEvents) :string
    {
        $hash = $this->convertHashToUrl($thirdPartySiteEvents->hash);

        return route('events.statistics.show', ['id' => $thirdPartySiteEvents->event_id, 'hash' => $hash]);
    }

    /**
     * Additionally convert the hash to md5-hash for the URL-address
     *
     * @param string $hash
     * @return string
     */
    private function convertHashToUrl(string $hash) :string
    {
        $hashHelper = new HashHelper();
        return $hashHelper->compute($hash);
    }
}