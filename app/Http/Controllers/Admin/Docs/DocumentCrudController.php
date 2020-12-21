<?php

namespace App\Http\Controllers\Admin\Docs;

use App\Models\File\File;
use App\Support\Backpack\CustomForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Docs\DocumentCrudRequest as StoreRequest;
use App\Http\Requests\Admin\Docs\DocumentCrudRequest as UpdateRequest;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin\Docs
 */
class DocumentCrudController extends CrudController
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
        $this->crud->setModel('App\Models\Docs\Document');
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/docs');
        $this->crud->setEntityNameStrings('Документ', 'Документы');
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
            'name' => 'id',
            'type' => 'text',
        ]);
        $this->crud->addColumn([
            'label' => 'Название',
            'name' => 'name',
        ]);

        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Название',
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
            'label' => 'Мета описание страницы',
            'name' => 'description',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Контент',
            'type' => 'ckeditor',
        ]);
        $this->crud->addField([
            'name' => 'attached_files',
            'label' => 'Файлы',
            'type' => 'browse_multiple',
        ]);

        $this->crud->enableAjaxTable();
    }

    /**
     * Запрос на создание документа
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = CustomForm::updateWithCustomBrowseMultiple(
            $this->crud, File::class, 'attached_files', 'files'
        );

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return parent::performSaveAction($item->id);
    }

    /**
     * Запрос на редактирование документа
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateWithCustomBrowseMultiple(
            $this->crud, File::class, 'attached_files', 'files'
        );

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return parent::performSaveAction($request->id);
    }
}
