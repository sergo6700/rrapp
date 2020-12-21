<?php

namespace App\Models\Notification;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Notification
 * @package App\Models\Notification
 */
class Notification extends Model
{
    /**
     * @var string
     */
    protected $table = 'notifications';

    /**
     * @var boolean
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'type_id'
    ];

}
