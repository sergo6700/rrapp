<?php

namespace App\Http\Controllers\Admin\User;

use App\Models\Acl\User;
use App\Support\Enum\User\UserRole;
use \Backpack\PermissionManager\app\Http\Controllers\UserCrudController as BackpackUserCrudController;
use App\Http\Resources\Admin\User\UserResource;
use App\Http\Resources\Admin\User\UserEventsResource;

/**
 * Class UserCrudController
 *
 * @package App\Http\Requests\Admin\User
 */
class UserCrudController extends BackpackUserCrudController
{
	/**
	 * Setup fields
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function setup(): void
	{
		/*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
		$this->crud->setModel(config('backpack.permissionmanager.models.user'));
		$this->crud->setEntityNameStrings(trans('backpack::permissionmanager.user'), trans('backpack::permissionmanager.users'));
		$this->crud->setRoute(backpack_url('user'));
        $this->crud->query->orderBy('created_at', 'desc');

        $this->crud->allowAccess('clone');
        $this->crud->enableExportButtons();

		// Columns.
		$this->crud->setColumns([
			[
				'name'  => 'id',
				'label' => trans('backpack::pagemanager.page_id'),
				'type'  => 'text',
			],
			[
				'name'  => 'created_at',
				'label' => trans('backpack::pagemanager.registration_date'),
				'type'  => 'text',
			],
			[
				'name'  => 'name',
				'label' => trans('backpack::pagemanager.full_name'),
				'type'  => 'text',
			],
			[
				'name'  => 'email',
				'label' => trans('backpack::pagemanager.email'),
				'type'  => 'email',
			],
			[
				'name'  => 'phone',
				'label' => trans('backpack::pagemanager.phone'),
				'type'  => 'text',
			],
			[
				'name'  => 'role_in_company_id',
				'label' => trans('backpack::permissionmanager.role'),
				'type'  => 'role_in_company'
			],
			[
				'name'  => 'tin',
				'label' => trans('backpack::pagemanager.tin'),
				'type'  => 'text',
			],
			[
				'name'  => 'custom_role',
				'label' => trans('backpack::pagemanager.custom_role'),
				'type'  => 'text',
			],
            [
                'name'  => 'company_name',
                'label' => trans('backpack::pagemanager.company_name'),
                'type'  => 'text',
            ],
            [
                'name'  => 'legal_address',
                'label' => 'Юридический адрес',
                'type'  => 'text',
            ],
            [
                'name'  => 'kpp',
                'label' => 'КПП',
                'type'  => 'text',
            ],
            [
                'name'  => 'ogrn',
                'label' => 'ОГРН',
                'type'  => 'text',
            ],
			[ // n-n relationship (with pivot table)
				'label'     => trans('backpack::pagemanager.function'), // Table column heading
				'type'      => 'select_multiple',
				'name'      => 'roles', // the method that defines the relationship in your Model
				'entity'    => 'roles', // the method that defines the relationship in your Model
				'attribute' => 'name', // foreign key attribute that is shown to user
				'model'     => config('permission.models.role'), // foreign key model
			],
			[ // n-n relationship (with pivot table)
				'label'     => trans('backpack::permissionmanager.extra_permissions'), // Table column heading
				'type'      => 'select_multiple',
				'name'      => 'permissions', // the method that defines the relationship in your Model
				'entity'    => 'permissions', // the method that defines the relationship in your Model
				'attribute' => 'name', // foreign key attribute that is shown to user
				'model'     => config('permission.models.permission'), // foreign key model
			],
		]);


		// Fields
		$this->crud->addFields([
			[
				'name'  => 'id',
				'label' => trans('backpack::pagemanager.page_id'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
				'attributes' => ['readonly' => 'readonly'],
			],
			[
				'name'  => 'created_at',
				'label' => trans('backpack::pagemanager.registration_date'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
				'attributes' => ['readonly' => 'readonly'],
			],
			[
				'name'  => 'name',
				'label' => trans('backpack::pagemanager.full_name'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'email',
				'label' => trans('backpack::pagemanager.email'),
				'type'  => 'email',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'phone',
				'label' => trans('backpack::pagemanager.phone'),
				'type'  => 'phone',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'tin',
				'label' => trans('backpack::pagemanager.tin'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'custom_role',
				'label' => trans('backpack::pagemanager.custom_role'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'company_name',
				'label' => trans('backpack::pagemanager.company_name'),
				'type'  => 'text',
				'tab' => trans('labels.personal_info'),
			],
            [
                'name'  => 'legal_address',
                'label' => 'Юридический адрес',
                'type'  => 'text',
                'tab' => trans('labels.personal_info'),
            ],
            [
                'name'  => 'kpp',
                'label' => 'КПП',
                'type'  => 'text',
                'tab' => trans('labels.personal_info'),
            ],
            [
                'name'  => 'ogrn',
                'label' => 'ОГРН',
                'type'  => 'text',
                'tab' => trans('labels.personal_info'),
            ],
			[
				'name'  => 'password',
				'label' => trans('backpack::permissionmanager.password'),
				'type'  => 'password',
				'tab' => trans('labels.personal_info'),
			],
			[
				'name'  => 'password_confirmation',
				'label' => trans('backpack::permissionmanager.password_confirmation'),
				'type'  => 'password',
				'tab' => trans('labels.personal_info'),
			],
			[
				// two interconnected entities
				'label'             => trans('backpack::permissionmanager.user_role_permission'),
				'field_unique_name' => 'user_role_permission',
				'type'              => 'checklist_dependency',
				'name'              => 'roles_and_permissions', // the methods that defines the relationship in your Model
				'subfields'         => [
					'primary' => [
						'label'            => trans('backpack::permissionmanager.roles'),
						'name'             => 'roles', // the method that defines the relationship in your Model
						'entity'           => 'roles', // the method that defines the relationship in your Model
						'entity_secondary' => 'permissions', // the method that defines the relationship in your Model
						'attribute'        => 'name', // foreign key attribute that is shown to user
						'model'            => config('permission.models.role'), // foreign key model
						'pivot'            => true, // on create&update, do you need to add/delete pivot table entries?]
						'number_columns'   => 3, //can be 1,2,3,4,6
					],
					'secondary' => [
						'label'          => ucfirst(trans('backpack::permissionmanager.permission_singular')),
						'name'           => 'permissions', // the method that defines the relationship in your Model
						'entity'         => 'permissions', // the method that defines the relationship in your Model
						'entity_primary' => 'roles', // the method that defines the relationship in your Model
						'attribute'      => 'name', // foreign key attribute that is shown to user
						'model'          => config('permission.models.permission'), // foreign key model
						'pivot'          => true, // on create&update, do you need to add/delete pivot table entries?]
						'number_columns' => 3, //can be 1,2,3,4,6
					],
				],
				'tab' => trans('labels.personal_info'),
			],

			[
				'name'  => 'upcoming_events',
				'type'  => 'user_events',
				'tab' => trans('labels.upcoming_events'),
			],

			[
				'name'  => 'past_events',
				'type'  => 'user_events',
				'tab' => trans('labels.past_events'),
			],
		]);

        $this->crud->addButtonFromView('line', 'view_user', 'view_user', 'beginning');
	}

    /**
     * @param int $id
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response|false|string
     */
    public function show($id)
    {
        $user = User::find($id);

        return json_encode([
            'personal_info' => new UserResource($user),
            'upcoming_events' => UserEventsResource::collection($user->upcoming_events),
            'past_events' => UserEventsResource::collection($user->past_events)
        ]);
    }


    /**
     * Добавить панель фильтров
     *
     * @return void
     */
    public function setFilters() :void
    {
        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'created_at',
            'label'=> 'Дата регистрации'
        ],
            false,
            function($value) {
                $this->crud->addClause('whereDate', 'created_at', '=', $value);
            });


        $this->crud->addFilter([
            'name' => 'name',
            'type' => 'select2_ajax',
            'label'=> 'ФИО',
            'placeholder' => 'Выберите ФИО'
        ],
            url('admin/user/ajax-column-search/name'),
            function($value) {
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'name' => 'email',
            'type' => 'select2_ajax',
            'label'=> 'Email',
            'placeholder' => 'Выберите email'
        ],
            url('admin/user/ajax-column-search/email'),
            function($value) {
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'name' => 'phone',
            'type' => 'select2_ajax',
            'label'=> 'Телефон',
            'placeholder' => 'Выберите телефон'
        ],
            url('admin/user/ajax-column-search/phone'),
            function($value) {
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'name' => 'tin',
            'type' => 'select2_ajax',
            'label'=> 'ИНН',
            'placeholder' => 'Выберите ИНН'
        ],
            url('admin/user/ajax-column-search/tin'),
            function($value) {
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'name' => 'company_name',
            'type' => 'select2_ajax',
            'label'=> 'Наименование компании',
            'placeholder' => 'Выберите наименование компании'
        ],
            url('admin/user/ajax-column-search/company_name'),
            function($value) {
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'roles',
            'label' => 'Функция'
        ], function() {
            return UserRole::getValues();
        }, function ($value) {
            $this->crud->query = $this->crud->query->whereHas('roles', function($query) use($value) {
                $query->where('id', $value);
            });
        });
    }

    /**
     * Поиск по указанной колонке таблицы 'users'
     *
     * @return mixed
     */
    public function columnSearch($column)
    {
        $term = $this->request->input('term');
        $options = User::where($column, 'like', '%'.$term.'%')->get();
        return $options->pluck($column, 'id');
    }
}
