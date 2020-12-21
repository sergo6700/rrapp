<?php

namespace App\Models\Email;

use App\Models\Service\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Email
 * @package App\Models\Email
 */
class Email extends Model
{
    /**
     * @var string
     */
    protected $table = 'emails';

    /**
     * @var array
     */
    protected $fillable = [
        'email'
    ];

    /**
     * Services of email relation
     * @return BelongsToMany
     */
    public function services(): BelongsToMany
    {
        return $this->morphedByMany(Service::class, 'emailable');
    }

}
