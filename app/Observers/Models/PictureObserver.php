<?php

namespace App\Observers\Models;

use App\Models\File\Picture;
use App\Events\Models\SaveAuth;
use App\Events\Models\Uuid;

class PictureObserver
{

    /**
     * Handle the app models file file "creating" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function creating(Picture $model)
    {
        new Uuid($model);
        new SaveAuth($model, 'user_id');
    }

    /**
     * Handle the app models file file "created" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function created(Picture $model)
    {
        //
    }

    /**
     * Handle the app models file file "updated" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function updated(Picture $model)
    {
        //
    }

    /**
     * Handle the app models file file "deleted" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function deleted(Picture $model)
    {
        //
    }

    /**
     * Handle the app models file file "restored" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function restored(Picture $model)
    {
        //
    }

    /**
     * Handle the app models file file "force deleted" event.
     *
     * @param  \App\Models\File\Picture  $model
     * @return void
     */
    public function forceDeleted(Picture $model)
    {
        //
    }
}
