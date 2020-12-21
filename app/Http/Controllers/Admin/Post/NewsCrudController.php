<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\File\Picture;
use App\Models\Post\NewsItem;
use App\Support\Backpack\CustomForm;
use App\Support\Enum\Post\VisibilityType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Post\NewsItemCrudRequest as StoreRequest;
use App\Http\Requests\Admin\Post\NewsItemCrudRequest as UpdateRequest;

/**
 * Class NewsCrudController
 * @package App\Http\Controllers\Admin\Post
 */
class NewsCrudController extends CrudController
{
    /**
     * Setup fields
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
        $this->crud->setModel('App\Models\Post\NewsItem');
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/news');
        $this->crud->setEntityNameStrings('Новость', 'Новости');
        $this->crud->query->orderBy('created_at', 'desc');

        $this->crud->allowAccess('clone');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | COLUMNS AND FIELDS
        |--------------------------------------------------------------------------
        */

        // ------ CRUD COLUMNS
        $this->crud->addColumns(
            [
                [
                    'label' => 'ID',
                    'name' => 'id',
                ],
                [
                    'label' => 'Название',
                    'name' => 'title',
                ],
                [
                    'label' => 'Дата публикации',
                    'name' => 'date',
                    'type' => 'date',
                ],
                [
                    'label' => 'Ограничение',
                    'name' => 'visibility_type_id',
                    'type' => 'visibility_type'
                ],
                [
                    'label' => 'Закреплён',
                    'name' => 'fixed',
                    'type' => 'checkbox_fixed'
                ]
            ]
        );

        $this->setFilters();


        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Заголовок',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Your title here',
        ]);
        $this->crud->addField([
            'label' => 'Ссылка (slug URL)', // TODO: перевести
            'name' => 'slug',
            'type' => 'text'
        ]);
        $this->crud->addField([
            'label' => 'Мета описание страницы',
            'name' => 'description',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'label' => 'Дата публикации',
            'name' => 'date',
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'ru'
            ],
            'allows_null' => false,
        ], 'create');
        $this->crud->addField([
            'name' => 'date',
            'label' => 'Дата публикации',
            'type' => 'datetime_picker',
            'datetime_picker_options' => [
                'format' => 'DD/MM/YYYY HH:mm',
                'language' => 'ru'
            ],
            'allows_null' => false,
        ], 'update');
        $this->crud->addField([
            'name' => 'content',
            'label' => 'Содержимое статьи',
            'type' => 'ckeditor',
            'placeholder' => 'Your textarea text here',
        ]);
        $this->crud->addField([
            'name' => 'image',
            'label' => 'Обложка',
            'type' => 'browse',
        ]);
        $this->crud->addField([
            'name' => 'visibility_type_id',
            'label' => 'Видимость',
            'type' => 'select_from_array',
            'options' => VisibilityType::getValues()
        ]);
        $this->crud->addField([
            'name' => 'fixed',
            'label' => 'Закрепить',
            'type' => 'checkbox_fixed'
        ]);

        $this->crud->enableAjaxTable();
    }

    /**
     * Создает NewsItem включая кастомную колонку image (форма) -> picture_id в таблице
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = CustomForm::updateWithCustomFileColumn($this->crud, Picture::class, 'image', 'picture_id');

        CustomForm::updateFixedFieldForAllModels($this->crud, $item);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return parent::performSaveAction($item->id);
    }

    /**
     * Обновляет Article включая кастомную колонку image (форма) -> picture_id в таблице
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateWithCustomFileColumn($this->crud, Picture::class, 'image', 'picture_id');

        CustomForm::updateFixedFieldForAllModels($this->crud);

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return parent::performSaveAction($request->id);
    }

    /**
     * Добавить панель фильтров
     *
     * @return void
     */
    public function setFilters() :void
    {
        $this->crud->addFilter([
            'name' => 'id',
            'type' => 'select2_ajax',
            'label'=> 'Название',
            'placeholder' => 'Выберите название'
        ],
            url('admin/news/ajax-name-search'), // the ajax route
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'id', $value);
            });

        $this->crud->addFilter([
            'type' => 'date',
            'name' => 'date',
            'label'=> 'Дата публикации'
        ],
            false,
            function($value) {
                $this->crud->addClause('where', 'date', '=', $value);
            });

        $this->crud->addFilter([
            'type' => 'dropdown',
            'name' => 'visibility_type_id',
            'label' => 'Ограничение'
        ], function() {
            return VisibilityType::getValues();
        }, function ($value) {
            $this->crud->addClause('where', 'visibility_type_id', $value);
        });
    }

    /**
     * Поиск по названию
     *
     * @return mixed
     */
    public function nameSearch() {
        $term = $this->request->input('term');
        $options = NewsItem::where('title', 'like', '%'.$term.'%')->get();
        return $options->pluck('title', 'id');
    }
}
