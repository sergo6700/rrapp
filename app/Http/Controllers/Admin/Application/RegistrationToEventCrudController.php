<?php

namespace App\Http\Controllers\Admin\Application;

use App\Models\Application\EventRegistration;
use App\Models\Event\Event;
use App\Models\Service\Service;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Exception;

/**
 * Class RegistrationToEventCrudController
 * @package App\Http\Controllers\Admin\Application
 */
class RegistrationToEventCrudController extends CrudController
{
    /**
     * RegistrationToEventCrudController setup
     * @throws Exception
     */
    public function setup() {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(EventRegistration::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/registration-to-event');
        $this->crud->setEntityNameStrings('Регистрация на мероприятие', 'Регистрации на мероприятие');
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
                'label' => 'Мероприятие',
                'name' => 'event.title',
                'type' => 'text',
            ],
            [
                'label' => 'Дата отправки',
                'name' => 'created_at',
            ],
            [
                'name' => 'fio',
                'label' => 'ФИО', // Table column heading
                'type' => 'user_full_name',
            ],
            [
                'name' => 'email',
                'label' => 'E-mail', // Table column heading
                'type' => 'model_function',
                'function_name' => 'getRegisteredUserEmail',
            ]
        ]);

        $this->crud->addFilter([ // select2 filter
            'name' => 'event_id',
            'type' => 'select2',
            'label'=> 'Мероприятие'
        ], function() {
            return Event::all()->pluck('title', 'id')->toArray();
        }, function($value) { // if the filter is active
            $this->crud->addClause('where', 'event_id', $value);
        });

        $this->crud->removeButton('create');
        $this->crud->removeButton('update');

        $this->crud->allowAccess('show');
        $this->crud->enableAjaxTable();
    }

    /**
     * Edit application
     */
    public function edit($id)
    {
        $application = EventRegistration::find($id);

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
                'name' => 'full_name',
                'label' => 'ФИО',
                'type' => 'text',
                'value' => $application->user->full_name ?? '',
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
                'label' => 'Наименование бизнеса',
                'type' => 'text',
                'value' => $application->user->company_name ?? '',
                'attributes' => [
                    'disabled' => 'disabled'
                ]
            ]
        ]);

        return parent::edit($id);
    }

    /**
     * Update application
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(): \Illuminate\Http\RedirectResponse
    {
        return $this->updateCrud();
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

        $this->crud->removeColumn('user_id');
        $this->crud->removeColumn('event_id');
        $this->crud->removeAllButtons();

        return $content;
    }
}
