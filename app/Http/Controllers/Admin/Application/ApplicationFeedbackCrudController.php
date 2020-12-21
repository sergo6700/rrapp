<?php

namespace App\Http\Controllers\Admin\Application;

use App\Models\Application\Application;
use App\Models\Service\Service;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Application\ApplicationRequest as UpdateRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\RedirectResponse;

/**
 * Class ApplicationFeedbackCrudController
 * @package App\Http\Controllers\Admin\Application
 */
class ApplicationFeedbackCrudController extends CrudController
{
    /**
     * ApplicationFeedbackCrudController setup
     * @throws Exception
     */
    public function setup() {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Application::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/application-feedback');
        $this->crud->setEntityNameStrings(
            'Заявка из формы обратной связи',
            'Заявки из формы обратной связи'
        );
        $this->crud->query->where('type_id', Application::FEEDBACK_TYPE);
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
			[
				'name' => 'kind_of_activity',
				'label' => 'Вид деятельности',
				'type' => 'text',
                'limit' => 30
			],
			[
				'name' => 'content',
				'label' => 'Текст сообщения',
				'type' => 'text',
				'limit' => 30
			]
        ]);

        $this->crud->removeButton('create');

        $this->crud->addButtonFromView('line', 'complete', 'complete', 'beginning');

        $this->crud->enableAjaxTable();
    }

    /**
     * Edit application feedback with user fields or application fields
     */
    public function edit($id)
    {
        $application = Application::find($id);

        if ($application->user) {
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
                    'name' => 'page_url',
                    'label' => 'Страница отправки',
                    'type' => 'textarea',
                    'value' => $application->page_url ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'name',
                    'label' => 'ФИО',
                    'type' => 'textarea',
                    'value' => $application->user->name ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'email',
                    'label' => 'E-mail',
                    'type' => 'textarea',
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
                    'name' => 'kind_of_activity',
                    'label' => 'Вид деятельности',
                    'type' => 'textarea',
                    'value' => $application->kind_of_activity ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'tin',
                    'label' => 'ИНН',
                    'type' => 'textarea',
                    'value' => $application->user->tin ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'company_name',
                    'label' => 'Наименование компании',
                    'type' => 'textarea',
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
                    'label' => 'Текст обращения',
                    'type' => 'textarea',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ]
            ]);

        } else {
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
                    'name' => 'page_url',
                    'label' => 'Страница отправки',
                    'type' => 'textarea',
                    'value' => $application->page_url ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'name',
                    'label' => 'ФИО',
                    'type' => 'textarea',
                    'value' => $application->full_name ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'email',
                    'label' => 'E-mail',
                    'type' => 'textarea',
                    'value' => $application->email ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'phone',
                    'label' => 'Телефон',
                    'type' => 'text',
                    'value' => $application->phone ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'kind_of_activity',
                    'label' => 'Вид деятельности',
                    'type' => 'textarea',
                    'value' => $application->kind_of_activity ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'tin',
                    'label' => 'ИНН',
                    'type' => 'textarea',
                    'value' => $application->tin ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'company_name',
                    'label' => 'Наименование компании',
                    'type' => 'textarea',
                    'value' => $application->company_name ?? '',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ],
                [
                    'name' => 'content',
                    'label' => 'Текст обращения',
                    'type' => 'textarea',
                    'attributes' => [
                        'disabled' => 'disabled'
                    ]
                ]
            ]);
        }

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
        $this->crud->removeColumn('page_title');

        return $content;
    }
}
