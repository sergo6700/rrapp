<?php

namespace App\Http\Controllers\Admin\User;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Exception;
use App\Models\Acl\User;
use App\Models\Event\Event;

/**
 * Class RegisteredUsersToEventCrudController
 * @package App\Http\Controllers\Admin\Event
 */
class RegisteredUsersToEventCrudController extends CrudController
{
	/**
	 * RegisteredUsersToEventCrudController constructor.
	 * @throws Exception
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Setup fields
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function setup() :void
	{
		$event_id = \Route::current()->parameter('event');
		$event = Event::findOrFail($event_id);

		/*
		|--------------------------------------------------------------------------
		| BASIC CRUD INFORMATION
		|--------------------------------------------------------------------------
		*/

		$this->crud->setModel(User::class);
		$this->crud->setRoute(config('backpack.base.route_prefix') . '/events/'.$event_id.'/users');

		$entityNameStrings = 'Список зарегистрированных пользователей на мероприятие "'.$event->title.'"';
		$this->crud->setEntityNameStrings($entityNameStrings, $entityNameStrings);

		$this->crud->query = $this->crud->query->whereHas('events', function ($query) use ($event_id) {
			$query->where('event_id', $event_id);
		});

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
				'label' => 'ФИО',
				'name' => 'name',
			],
			[
				'label' => 'Email',
				'name' => 'email',
			],
			[
				'label' => 'Телефон',
				'name' => 'phone',
			],
			[
				'label' => 'ИНН',
				'name' => 'tin',
			],
			[
				'label' => 'Наименование бизнеса',
				'name' => 'company_name',
			],
            [
                'label' => 'Источник',
                'type' => 'source',
            ],
		]);

		$this->crud->removeAllButtons();
		$this->crud->enableAjaxTable();
	}
}
