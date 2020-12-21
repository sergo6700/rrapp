<?php

namespace App\Models\Address;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\Models\Address
 */
class Address extends Model
{
    use SoftDeletes, CrudTrait;

    /**
     * @var string
     */
    protected $table = 'addresses';

    /**
     * @var array
     */
    protected $fillable = [
        'title', 'latitude', 'longitude'
    ];
}
