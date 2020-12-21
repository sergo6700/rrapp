<?php

namespace App\Events\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Events\Models\Uuid - event для автоматической генерации поля uuid
 *
 * @package App\Events\Models
 */
class Uuid
{
    /**
     * [$model description]
     *
     * @var [type]
     */
    public $model;

    /**
     * Create a new event instance.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        if (empty($model->uuid)) {
            $model->uuid = (string) Str::uuid();
        }
    }

}
