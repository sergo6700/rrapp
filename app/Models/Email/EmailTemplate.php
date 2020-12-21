<?php

namespace App\Models\Email;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmailTemplate
 * @package App\Models\Email
 */
class EmailTemplate extends Model
{
    use CrudTrait;
    /**
     * @var string
     */
    protected $table = 'email_templates';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'type_id',
        'content',
    ];

}
