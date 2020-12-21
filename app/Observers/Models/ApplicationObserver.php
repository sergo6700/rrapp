<?php

namespace App\Observers\Models;

use App\Jobs\ApplicationCreated;
use App\Models\Application\Application;

/**
 * Class ApplicationObserver
 * @package App\Observers\Models
 */
class ApplicationObserver
{

    /**
     * Handle the app models file file "creating" event.
     *
     * @param Application $model
     * @return void
     */
    public function creating(Application $model): void
    {
    }

    /**
     * Handle the app models file file "created" event.
     *
     * @param Application $model
     * @return void
     */
    public function created(Application $model): void
    {
        \Queue::pushOn('default', new ApplicationCreated($model));
    }

    /**
     * Handle the app models file file "updated" event.
     *
     * @param Application $model
     * @return void
     */
    public function updated(Application $model): void
    {
        //
    }

    /**
     * Handle the app models file file "deleted" event.
     *
     * @param Application $model
     * @return void
     */
    public function deleted(Application $model): void
    {
        //
    }

    /**
     * Handle the app models file file "restored" event.
     *
     * @param Application $model
     * @return void
     */
    public function restored(Application $model): void
    {
        //
    }

    /**
     * Handle the app models file file "force deleted" event.
     *
     * @param Application $model
     * @return void
     */
    public function forceDeleted(Application $model): void
    {
        //
    }
}
