<?php

namespace App\Http\Controllers\Admin\Division;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Division\DivisionCrudRequest as StoreRequest;
use App\Http\Requests\Admin\Division\DivisionCrudRequest as UpdateRequest;

/**
 * Class DivisionCrudController
 * @package App\Http\Controllers\Admin\Division
 */
class DivisionCrudController extends CrudController
{
    /**
     * ArticleCrudController constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Division\Division');
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/departments'); // TODO: or /division?
        $this->crud->setEntityNameStrings('Подразделение', 'Подразделения');
        $this->crud->query->orderBy('created_at', 'desc');

        $this->crud->allowAccess('clone');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumn([
            'label' => 'ID',
            'name' => 'id'
        ]);
        $this->crud->addColumn([
            'label' => 'Название',
            'name' => 'name',
        ]);
        $this->crud->addColumn([
            'name' => 'position',
            'label' => 'Позиция на странице',
        ]);


        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Заголовок',
            'name' => 'name',
            'type' => 'text',
        ]);
        $this->crud->addField([
			'label' => 'Ссылка (slug URL)',
			'name' => 'slug',
			'type' => 'text',
			'hint' => trans('backpack::pagemanager.page_slug_hint'),
		]);
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Контент',
            'type' => 'ckeditor',
        ]);
        $this->crud->addField([
            'name' => 'position',
            'label' => 'Позиция на странице',
            'type' => 'position',
            'default' => 0
        ]);

        $this->crud->enableAjaxTable();
    }

    /**
     * Запрос на создание подразделения
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        return parent::storeCrud();
    }

    /**
     * Запрос на редактирование подразделения
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud();
    }
}
