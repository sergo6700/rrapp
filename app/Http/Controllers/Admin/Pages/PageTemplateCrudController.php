<?php
namespace App\Http\Controllers\Admin\Pages;

use App\Models\Pages\PageTemplate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Pages\PageTemplate\PageTemplateRequest as StoreRequest;
use App\Http\Requests\Admin\Pages\PageTemplate\PageTemplateRequest as UpdateRequest;

class PageTemplateCrudController extends CrudController
{
    /**
     * PageTemplateCrudController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setup crud model
     *
     * @throws \Exception
     */
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(PageTemplate::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/page-template');
        $this->crud->setEntityNameStrings('шаблон', 'шаблоны страниц');

        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->setColumns();
        $this->setFields();
    }

    /**
     * Set table list columns
     *
     * @return void
     */
    public function setColumns()
    {
        $this->crud->setColumns([
            [
                'label' => 'Название шаблона',
                'type' => 'text',
                'name' => 'name',
                'searchLogic' => true,
            ],
            [
                'name' => 'template',
                'label' => 'Основной шаблон',
                'type' => 'model_function',
                'function_name' => 'getTemplateName',
            ],
            [
                'label' => 'Название базового CSS класса',
                'type' => 'text',
                'name' => 'class_name',
                'searchLogic' => true,
            ],
            [
                'label' => 'Стили (CSS)',
                'type' => 'textarea',
                'name' => 'styles',
                'searchLogic' => false,
            ],
        ]);
    }

    /**
     * Set form fields
     *
     * @param bool $template
     */
    public function setFields($template = false)
    {
        $this->crud->addFields([
            [
                'label' => 'Название',
                'type' => 'text',
                'name' => 'name',
                'searchLogic' => true,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'name' => 'template',
                'label' => trans('backpack::pagemanager.template'),
                'type' => 'select_from_array',
                'options' => PageTemplate::getTemplates(),
                'allows_null' => false,
                'wrapperAttributes' => [
                    'class' => 'form-group col-md-6',
                ],
            ],
            [
                'label' => 'Название базового CSS класса',
                'type' => 'text',
                'name' => 'class_name',
                'searchLogic' => true,
            ],
            [
                'label' => 'Стили (CSS)',
                //'type' => 'css-editor',
                'type' => 'textarea',
                'name' => 'styles',
                'searchLogic' => false,
                'attributes' => [
                    'style' => 'width:100%; min-height:300px; resize: vertical; ',
                ]
            ],
        ]);
    }

    /**
     * Save request on create
     *\
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Backpack\CRUD\Exception\AccessDeniedException
     */
    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');
        $this->crud->setOperation('create');

        // set fields for create
        $fields = array_merge($request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']), [
            'template' => PageTemplate::getTemplates($request->template)
        ]);

        // insert item in the db
        $item = $this->crud->create($fields);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction($item->getKey());
    }

    /**
     * Save request on edit
     *
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Backpack\CRUD\Exception\AccessDeniedException
     */
    public function update(UpdateRequest $request)
    {
        $this->crud->hasAccessOrFail('update');
        $this->crud->setOperation('update');

        // set fields for create
        $fields = array_merge($request->except(['save_action', '_token', '_method', 'current_tab', 'http_referrer']), [
            'template' => PageTemplate::getTemplates($request->template)
        ]);

        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()), $fields);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->setSaveAction();

        return $this->performSaveAction($item->getKey());
    }

}
