<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Schema;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->setSchemaSettings();
        $this->loadMigrationPaths();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('components.layouts.includes.collapses', 'App\Http\Composers\TopFixedBlockComposer');

        $is_red_panel_closed = $this->app->request->cookie('is_red_panel_closed');
        view()->composer('components.layouts.sections.side-panel', function ($view) use ($is_red_panel_closed){
           $view->with('is_red_panel_closed', $is_red_panel_closed);
        });

        View::share('user_roles', array_combine(Arr::pluck(config('handbook.user_roles'), 'id'), config('handbook.user_roles')));
        View::share('notification_types', config('handbook.notification_types'));
    }

    /**
     * Set mysql default Schema settings
     *
     * @return void
     */
    protected function setSchemaSettings()
    {
        // for good migrations
        Schema::defaultStringLength(191);
    }

    /**
     * Load migration sub-directories
     *
     * @return void
     */
    protected function loadMigrationPaths()
    {
        $mainPath = database_path('migrations');
        $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
        $paths = array_merge([$mainPath], $directories);

        $this->loadMigrationsFrom($paths);
    }
}
