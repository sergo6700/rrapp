<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Models\Pages\PageTemplate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Pages\Page\PageRequest as StoreRequest;
use App\Http\Requests\Admin\Pages\Page\PageRequest as UpdateRequest;

/**
 * Class PageCrudController
 * @package App\Http\Controllers\Admin\Pages
 */
class PageCrudController extends CrudController
{

    /**
     * PageCrudController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setup CRUD controller
     *
     * @param bool $template_name
     * @throws \Exception
     */
    public function setup($template_name = false)
    {
        parent::__construct();

        $modelClass = config('backpack.pagemanager.page_model_class', 'Backpack\PageManager\app\Models\Page');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel($modelClass);
        $this->crud->setRoute(config('backpack.base.route_prefix').'/page');
        $this->crud->setEntityNameStrings(trans('backpack::pagemanager.page'), trans('backpack::pagemanager.pages'));
        $this->crud->query->orderBy('created_at', 'desc');

        $this->crud->allowAccess('clone');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | COLUMNS
        |--------------------------------------------------------------------------
        */

        $this->setColumns();
        $this->setFields();

        /*
        |--------------------------------------------------------------------------
        | BUTTONS
        |--------------------------------------------------------------------------
        */
        $this->crud->addButtonFromModelFunction('line', 'open', 'getOpenButton', 'beginning');
    }

    /**
     * Set table list columns
     *
     * @return void
     */
    public function setColumns()
    {
        $this->crud->addColumns([
            [
              'name' => 'id',
              'label' => trans('backpack::pagemanager.page_id')
            ],
            [
                'name' => 'title',
                'label' => trans('backpack::pagemanager.page_title'),
            ],
            [
                'name' => 'slug',
                'label' => trans('backpack::pagemanager.slug'),
            ]
        ]);
    }

    /**
     * Populate the create/update forms with basic fields, that all pages need.
     *
     * @return void
     */
    public function setFields()
    {
        $this->crud->addFields([
            [
                'label' => 'Шаблон страницы',
                'name' => 'template_id',
                'type' => 'select',
                'name' => 'template_id',
                'entity' => 'pageTemplate',
                'attribute' => 'name',
                'model' => PageTemplate::class,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6 hide',1
                ],
            ],
            [
                'name' => 'title',
                'label' => trans('backpack::pagemanager.page_title'),
                'type' => 'text',
            ],
            [
                'name' => 'slug',
                'label' => trans('backpack::pagemanager.page_slug'),
                'type' => 'text',
                'hint' => trans('backpack::pagemanager.page_slug_hint'),
            ],
            [
                'name' => 'description',
                'label' => 'Мета описание страницы',
            ],

            // CONTENT FIELDS
            [
                'name' => 'content_separator',
                'type' => 'custom_html',
                'value' => '<br><h2>'.trans('backpack::pagemanager.content').'</h2><hr>',
            ],
            [
                'name' => 'content',
                'label' => trans('backpack::pagemanager.content'),
                'type' => 'wysiwyg',
                'placeholder' => trans('backpack::pagemanager.content_placeholder'),
            ],

            // SEO FIELDS
//            [
//                'name' => 'metas_separator',
//                'type' => 'custom_html',
//                'value' => '<br><h2>'.trans('backpack::pagemanager.metas').'</h2><hr>',
//            ],
//            [
//                'name' => 'meta_title',
//                'label' => trans('backpack::pagemanager.meta_title'),
//                'fake' => true,
//                'store_in' => 'extras',
//            ],
//            [
//                'name' => 'meta_description',
//                'label' => trans('backpack::pagemanager.meta_description'),
//                'fake' => true,
//                'store_in' => 'extras',
//            ],
//            [
//                'name' => 'meta_keywords',
//                'type' => 'textarea',
//                'label' => trans('backpack::pagemanager.meta_keywords'),
//                'fake' => true,
//                'store_in' => 'extras',
//            ],
        ]);
    }

    /**
     * Overwrites the CrudController store() method to add template usage.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    /**
     * Overwrites the CrudController update() method to add template usage.
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }

}
