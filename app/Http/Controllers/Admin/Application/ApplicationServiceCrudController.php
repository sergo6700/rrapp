<?php

namespace App\Http\Controllers\Admin\Application;

use App\Models\Application\Application;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Application\ApplicationRequest as UpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use App\Models\Service\Service;

/**
 * Class ApplicationServiceCrudController
 * @package App\Http\Controllers\Admin\Application
 */
class ApplicationServiceCrudController extends CrudController
{
    /**
     * ApplicationServiceCrudController setup
     * @throws Exception
     */
    public function setup() {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Application::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/application-service');
        $this->crud->setEntityNameStrings('Заявка на услугу', 'Заявки на услугу');
        $this->crud->query->where('type_id', Application::SERVICE_TYPE);
        $this->crud->orderBy('created_at', 'desc');

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
                'label' => 'Дата отправки',
                'name' => 'created_at',
            ],
            [
                'name' => 'service.title',
                'label' => 'Услуга',
                'type' => 'text',
                'limit' => '35',
            ],
            [
                'name' => 'fio',
                'label' => 'ФИО',
                'type' => 'user_full_name',
            ],
            [
                'name' => 'email',
                'label' => 'E-mail',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserEmail',
            ],
            [
                'name' => 'completed',
                'label' => 'Статус',
                'type' => 'model_function',
                'function_name' => 'getApplicationStatus',
            ],
			[
				'name' => 'phone',
				'label' => 'Телефон',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserPhone'
			],
			[
				'name' => 'tin',
				'label' => 'ИНН',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserTin'
			],
			[
				'name' => 'company_name',
				'label' => 'Наименование компании',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserCompanyName'
			],
            [
                'name' => 'legal_address',
                'label' => 'Юридический адрес',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserLegalAddress'
            ],
            [
                'name' => 'kpp',
                'label' => 'КПП',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserKpp'
            ],
            [
                'name' => 'ogrn',
                'label' => 'ОГРН',
                'type' => 'model_function',
                'function_name' => 'getApplicationUserOgrn'
            ],
            [
                'name' => 'page_url',
                'label' => 'Страница отправки',
                'type' => 'page_url',
            ],
//            [
//                'name' => 'subject',
//                'label' => 'Тема обращения'
//            ],
			[
				'name' => 'content',
				'label' => 'Текст сообщения',
				'type' => 'text',
				'limit' => 30
			],
			[
				'name' => 'is_completed',
				'label' => 'Отметка о завершении работ по заявке',
				'type' => 'check'
			],
        ]);

        $this->crud->addFilter([ // select2 filter
            'name' => 'service_id',
            'type' => 'select2',
            'label'=> 'Услуга'
        ], function() {
            return Service::all()->pluck('title', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'service_id', $value);
        });

        $this->crud->removeButton('create');

        $this->crud->addButtonFromView('line', 'complete', 'complete', 'beginning');

        $this->crud->enableAjaxTable();
    }

    /**
     * Complete application
     * @param Application $application
     * @return RedirectResponse
     */
    public function complete(Application $application)
    {
        $application->update(['is_completed' => 1]);
        return redirect()->back();
    }

    /**
     * Return to work application
     * @param Application $application
     * @return RedirectResponse
     */
    public function returnToWork(Application $application)
    {
        $application->update(['is_completed' => 0]);
        return redirect()->back();
    }

    /**
     * Edit application
     */
    public function edit($id)
    {
        $application = Application::find($id);

        $this->crud->addFields([
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
                'attributes' => [
                    'readonly' => 'readonly'
                ]
            ],
            [
                'name' => 'created_at',
                'label' => 'Дата отправки',
                'type' => 'datetime',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'name',
                'label' => 'ФИО',
                'type' => 'text',
                'value' => $application->user->name ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'email',
                'label' => 'E-mail',
                'type' => 'text',
                'value' => $application->user->email ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'phone',
                'label' => 'Телефон',
                'type' => 'text',
                'value' => $application->user->phone ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'tin',
                'label' => 'ИНН',
                'type' => 'text',
                'value' => $application->user->tin ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'company_name',
                'label' => 'Наименование компании',
                'type' => 'text',
                'value' => $application->user->company_name ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'legal_address',
                'label' => 'Юридический адрес',
                'type' => 'text',
                'value' => $application->getApplicationUserLegalAddress(),
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'kpp',
                'label' => 'КПП',
                'type' => 'text',
                'value' => $application->getApplicationUserKpp(),
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'ogrn',
                'label' => 'ОГРН',
                'type' => 'text',
                'value' => $application->getApplicationUserOgrn(),
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'content',
                'label' => 'Сопровождающий текст',
                'type' => 'textarea',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ],
            [
                'name' => 'is_completed',
                'label' => 'Работа по заявке завершена',
                'type' => 'checkbox'
            ]
        ]);

        return parent::edit($id);
    }

    /**
     * Update application
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request): RedirectResponse
    {

        return $this->updateCrud($request);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function show($id)
    {
        $content = parent::show($id);

        $this->crud->removeColumn('service_id');
        $this->crud->removeColumn('full_name');
        $this->crud->removeColumn('subject');
        $this->crud->removeColumn('user_id');
        $this->crud->removeColumn('type_id');
        $this->crud->removeColumn('is_completed');
        $this->crud->removeColumn('kind_of_activity');

        return $content;
    }
}
