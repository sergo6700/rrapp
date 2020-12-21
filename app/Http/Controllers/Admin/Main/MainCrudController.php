<?php

namespace App\Http\Controllers\Admin\Main;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\CrudPanel;

/**
 * Class MainCrudController
 * @package App\Http\Controllers\Admin\Main
 * @property-read CrudPanel $crud
 */
class MainCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\PageMetadata\PageMetadata');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/main');
        $this->crud->setEntityNameStrings('Главная страница', 'Главная страница');
        $this->crud->removeAllButtons();
    }
}
