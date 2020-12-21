<?php

namespace App\Events\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Events\Models\Uuid - event для автоматической генерации поля авторизации
 *
 * @package App\Events\Models
 */
class SaveAuth
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Model field name for user auth
     *
     * @var string
     */
    protected $field;

    /**
     * Auth guard (default = null)
     *
     * @var null|string
     */
    protected $guard;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Model $model, string $field, ?string $guard = null)
    {
        $model->{$field} = auth($guard)->check()
            ? auth($guard)->user()->id
            : null;
    }

}
