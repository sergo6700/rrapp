<?php

namespace App\Observers\Models;

use App\Models\File\File;
use App\Events\Models\SaveAuth;
use App\Events\Models\Uuid;

class FileObserver
{

    /**
     * Handle the app models file file "creating" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function creating(File $model)
    {
        new Uuid($model);
        new SaveAuth($model, 'user_id');
    }

    /**
     * Handle the app models file file "created" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function created(File $model)
    {
        //
    }

    /**
     * Handle the app models file file "updated" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function updated(File $model)
    {
        //
    }

    /**
     * Handle the app models file file "deleted" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function deleted(File $model)
    {
        //
    }

    /**
     * Handle the app models file file "restored" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function restored(File $model)
    {
        //
    }

    /**
     * Handle the app models file file "force deleted" event.
     *
     * @param  \App\Models\File\File  $model
     * @return void
     */
    public function forceDeleted(File $model)
    {
        //
    }
}
