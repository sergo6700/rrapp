<?php

namespace App\Http\Controllers\Admin\Event;

use App\Models\Address\Address;
use App\Models\File\File;
use App\Support\Backpack\CustomForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Event\EventRequest as StoreRequest;
use App\Http\Requests\Admin\Event\EventRequest as UpdateRequest;
use App\Models\Event\Event;
use App\Models\Division\Division;
use Carbon\Carbon;
use Exception;

/**
 * Class UpcomingEventCrudController
 * @package App\Http\Controllers\Admin\Event
 */
class UpcomingEventCrudController extends CrudController
{
    /**
     * Setup fields
     *
     * @return void
     * @throws Exception
     */
    public function setup() :void
    {
        parent::__construct();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Event::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/upcoming-events');
        $this->crud->setEntityNameStrings('Будущее мероприятие', 'Будущие мероприятия');

        $currentTime = Carbon::now();
        $date = $currentTime->format('Y-m-d');
		$this->crud->query->whereDate('date_to', '>=', $date)->orWhere(function ($query) use ($date) {
			$query->whereNull('date_to')->whereDate('date_from', '>=', $date);
		});
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
                'label' => 'Дата и время проведения',
                'name' => 'date_from',
                'type' => 'datetime',
            ],
            [
                'label' => 'Название',
                'name' => 'title',
            ],
            [
                'name' => 'division',
                'label' => 'Организатор',
                'type' => 'model_function',
                'function_name' => 'getDivisionName',
            ],
            [
                'name' => 'count_registered',
                'label' => 'Зарегистрировалось',
                'type' => 'model_function',
                'function_name' => 'getCountRegistered',
            ]
        ]);

        $this->setFilters();


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
                'label' => 'Дата и время проведения',
                'name' => 'date_from',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'ru'
                ],
                'allows_null' => false,
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
                'label' => 'Место проведения',
                'type' => 'yandex_map',
                'name' => 'address',
            ],
            [
                'label' => 'Максимальное количество участников',
                'name' => 'visitors_count',
                'type' => 'number',
				'default' => 0
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
				'name' => 'list_registered_users',
				'label' => 'Список зарегистрированных пользователей',
				'type' => 'button_list_registered_users',
			],
            [
                'name' => 'view_iframe',
                'label' => 'iframe для встраивания на сторонний сайт',
                'type' => 'view_iframe',
            ],
            [
                'name' => 'secret_link',
                'label' => 'Страница для просмотра зарегистрировавшихся пользователей через iframe',
                'type' => 'secret_link',
            ],
        ]);

        $this->crud->enableAjaxTable();
    }

    /**
     * Создает Event включая кастомную колонку file (форма) -> report_file_id в таблице
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = CustomForm::updateWithCustomFileColumn(
            $this->crud,
            File::class,
            'report',
            'report_file_id'
        );

        CustomForm::updateWithCustomAddressColumn(
            $this->crud,
            Address::class,
            'address_hidden',
            'address_id',
            $item->id
        );

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return $this->performSaveAction($item->id);
    }

    /**
     * Обновляет Event включая кастомную колонку file (форма) -> report_file_id в таблице
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateWithCustomFileColumn(
            $this->crud,
            File::class,
            'report',
            'report_file_id'
        );

        CustomForm::updateWithCustomAddressColumn(
            $this->crud,
            Address::class,
            'address_hidden',
            'address_id',
            $request->id
        );

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return $this->performSaveAction($request->id);
    }

    /**
     * Поиск по названию мероприятия
     *
     * @return mixed
     */
    public function nameEventSearch() {
        $term = $this->request->input('term');
        $options = Event::where('title', 'like', '%'.$term.'%')->get();
        return $options->pluck('title', 'id');
    }

    /**
     * Добавить панель фильтров
     *
     * @return void
     */
    public function setFilters() :void
    {
        $this->crud->addFilter([
            'type' => 'date_range',
            'name' => 'date_from',
            'label'=> 'Дата и время проведения'
        ],
            false,
            function($value) {
                $dates = json_decode($value);

                $this->crud->addClause('whereBetween', 'date_from', [$dates->from, $dates->to . " 23:59:59"]);
            });


        $this->crud->addFilter([ // select2_ajax filter
            'name' => 'id',
            'type' => 'select2_ajax',
            'label'=> 'Название мероприятия',
            'placeholder' => 'Выберите название мероприятия'
        ],
            url('admin/upcoming-events/ajax-name-event-search'), // the ajax route
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'id', $value);
            });


        $this->crud->addFilter([
            'type' => 'select2',
            'name' => 'division_id',
            'label'=> 'Организатор'
        ],
            function() {
                return Division::all()->pluck('name', 'id')->toArray();
            }, function($value) {
                 $this->crud->addClause('where', 'division_id', $value);
            });
    }
}
