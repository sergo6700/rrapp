<?php

return [
    /**
     * -------------------------------------------------------------------------------------
     * Change this class if you wish to extend PageCrudController
     * -------------------------------------------------------------------------------------
     */

    'admin_controller_class' => \App\Http\Controllers\Admin\Pages\PageCrudController::class,

    /**
     * -------------------------------------------------------------------------------------
     * Change this class if you wish to extend the Page model
     * -------------------------------------------------------------------------------------
     */

    'page_model_class'       => \App\Models\Pages\Page::class,

    /**
     * -------------------------------------------------------------------------------------
     * Path to templates folder
     * -------------------------------------------------------------------------------------
     */

    'templates_path_pattern' => base_path().'/resources/views/web/pages/*.blade.php',
];
