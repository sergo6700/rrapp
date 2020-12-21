<?php

namespace App\Events\Models;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

/**
 * Class AbstractApplicationCreated
 *
 * @package App\Events\Models
 */
class AbstractApplicationCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $model;

    /**
     * Create a new event instance.
     *
     * @param Model $model Eloquent model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
