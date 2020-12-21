<?php

namespace App\Models\Application;

use App\Models\Acl\User;
use App\Models\Event\Event;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class EventRegistration
 * @package App\Models\Application
 */
class EventRegistration extends Model
{
    use CrudTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'event_registrations';

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
    ];

    /**
     * User of application relation
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Application of application relation
     * @return BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Get registered user full name
     * @return string
     */
    public function getRegisteredUserFullName(): string
    {
        return $this->user->name;
    }

    /**
     * Get registered user email
     * @return string
     */
    public function getRegisteredUserEmail(): string
    {
        return $this->user->email;
    }
}
