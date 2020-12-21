<?php

namespace App\Http\Controllers\Admin\Service;

use App\Support\Backpack\CustomForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Service\ServiceRequest as StoreRequest;
use App\Http\Requests\Admin\Service\ServiceRequest as UpdateRequest;
use App\Models\Division\Division;
use App\Models\Service\Service;
use App\Models\Email\Email;
use App\Models\Tag\Tag;
use Exception;

/**
 * Class ServiceCrudController
 * @package App\Http\Controllers\Admin\Application
 */
class ServiceCrudController extends CrudController
{
    /**
     * ServiceCrudController constructor.
     * @throws Exception
     */
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Service::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/services');
        $this->crud->setEntityNameStrings('Услуга', 'Услуги');
        $this->crud->query->orderBy('created_at', 'desc');

        $this->crud->allowAccess('clone');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumns([
            [
                'label' => 'ID',
                'name' => 'id',
            ],
            [
                'label' => 'Название',
                'name' => 'title',
                'orderable' => true,
            ],
			[
				'label' => 'Ссылка (slug URL)',
				'name' => 'slug',
				'type' => 'text',
				'hint' => trans('backpack::pagemanager.page_slug_hint'),
                'limit' => '30',
                'orderable' => true,
			],
            [
                'name' => 'division',
                'label' => 'Организатор',
                'type' => 'model_function',
                'function_name' => 'getDivisionName',
                'limit' => '30',
                'orderable' => true,
            ],
            [
                'name' => 'emails',
                'label' => 'Email',
                'type' => 'model_function',
                'function_name' => 'getEmails',
                'limit' => '30',
                'orderable' => true,
                'priority' => 1,
            ],
            [
                'name' => 'total_applications',
                'label' => 'Всего заявок',
                'type' => 'model_function',
                'function_name' => 'getTotalApplications',
                'orderable' => true,
            ],
            [
                'name' => 'new_applications',
                'label' => 'Новых заявок',
                'type' => 'model_function',
                'function_name' => 'getNewApplications',
                'orderable' => true,
            ],
            [
                'name' => 'position',
                'label' => 'Позиция на странице',
                'orderable' => true,
            ],
        ]);


        // ------ CRUD FIELDS
        $this->crud->addFields([
            [
                'label' => 'Название',
                'name' => 'title',
                'type' => 'text',
            ],
            [
                'label' => 'Ссылка (slug URL)',
                'name' => 'slug',
                'type' => 'text',
                'hint' => trans('backpack::pagemanager.page_slug_hint'),
            ],
            [
                'label' => 'Мета описание страницы',
                'name' => 'description',
                'type' => 'text',
            ],
            [
                'label' => 'Организатор',
                'type' => 'select',
                'name' => 'division_id',
                'entity' => 'division',
                'attribute' => 'name',
                'model' => Division::class,
            ],
            [
                'label' => 'E-mail',
                'type' => 'select2_multiple_email',
                'name' => 'emails',
                'entity' => 'emails',
                'attribute' => 'email',
                'model' => Email::class,
                'pivot' => true,
            ],
            [
                'label' => 'Теги',
                'type' => 'select2_multiple_tags',
                'name' => 'tags',
                'entity' => 'tags',
                'attribute' => 'name',
                'model' => Tag::class,
                'pivot' => true,
				'morph' => true,
            ],
            [
                'name' => 'short_content',
                'label' => 'Краткое описание',
                'type' => 'textarea',
            ],
            [
                'name' => 'full_content',
                'label' => 'Полное описание',
                'type' => 'wysiwyg',
            ],
            [
                'name' => 'is_show_on_main',
                'label' => 'Показывать на главной',
                'type' => 'checkbox',
            ],
			[
				'name' => 'button_list_applications',
				'label' => 'Список заявок',
				'type' => 'button_list_applications',
			],
            [
                'name' => 'position',
                'label' => 'Позиция на странице',
                'type' => 'position',
                'default' => 0
            ]
        ]);

        $this->crud->enableAjaxTable();
        $this->crud->disableResponsiveTable();

    }

    /**
     * Создает Event включая кастомную колонку
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = CustomForm::updateServiceWithCustomFields($this->crud);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return $this->performSaveAction($item->id);
    }

    /**
     * Обновляет Event включая кастомную колонку
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateServiceWithCustomFields($this->crud);

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return $this->performSaveAction($request->id);
    }
}
