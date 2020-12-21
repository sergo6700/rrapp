<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class AccessToEventsData
 * @package App\Models\Event
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $hash
 *
 */

class AccessToEventsData extends Model
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'access_to_events_data';

    /**
     * @var array
     */
    protected $fillable = [
        'event_id',
        'hash'
    ];

    /**
     * Return Event model
     *
     * @return BelongsTo
     */
    public function event() :BelongsTo
    {
        return $this->belongsTo('App\Models\Event\Event');
    }
}
