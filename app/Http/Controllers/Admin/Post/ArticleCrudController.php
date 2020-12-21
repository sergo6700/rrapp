<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\File\Picture;
use App\Support\Backpack\CustomForm;
use App\Support\Enum\Post\VisibilityType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Post\ArticleCrudRequest as StoreRequest;
use App\Http\Requests\Admin\Post\ArticleCrudRequest as UpdateRequest;
use Exception;
use Illuminate\Http\Response;
use App\Models\Post\Article;


/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin\Post
 */
class ArticleCrudController extends CrudController
{
    /**
     * Setup fields
	 *
     * @throws Exception
     */
    public function setup()
	{
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Article::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin') . '/articles');
        $this->crud->setEntityNameStrings('Статья', 'Статьи');
        $this->crud->query->where('is_video', false);
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
		]);

        $this->setFilters();

        $article_view_type_temp = config('handbook.article_view_type');
        $article_view_type = array_flip(array_column($article_view_type_temp, 'id', 'name'));

        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Заголовок',
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Your title here',
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
            'label' => 'Дата публикации',
            'name' => 'date',
			'type' => 'datetime_picker',
			'datetime_picker_options' => [
				'format' => 'DD/MM/YYYY HH:mm',
				'language' => 'ru'
			],
			'allows_null' => false,
			//'default' => date('Y-m-d H:i:s'),
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
            'type' => 'browse'
        ]);
        $this->crud->addField([
            'name' => 'view_id',
            'label' => 'Вид снипета в списке',
            'type' => 'select_from_array',
            'options' => $article_view_type
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
     * Создает Article включая кастомную колонку image (форма) -> picture_id в таблице
     * @param UpdateRequest $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
		$item = CustomForm::updateWithCustomFileColumn(
			$this->crud,
			Picture::class,
			'image',
			'picture_id'
		);

		CustomForm::updateFixedFieldForAllModels($this->crud, $item);

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return $this->performSaveAction($item->id);
    }

    /**
     * Обновляет Article включая кастомную колонку image (форма) -> picture_id в таблице
     * @param UpdateRequest $request
     * @return Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateWithCustomFileColumn(
            $this->crud,
            Picture::class,
            'image',
            'picture_id'
        );

        CustomForm::updateFixedFieldForAllModels($this->crud);

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return $this->performSaveAction($request->id);
    }

    /**
     * Добавить панель фильтров
     *
     * @return void
     */
    public function setFilters() :void
    {
        $this->crud->addFilter([ // select2_ajax filter
            'name' => 'id',
            'type' => 'select2_ajax',
            'label'=> 'Название',
            'placeholder' => 'Выберите название'
        ],
            url('admin/article/ajax-name-search'), // the ajax route
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
        $options = Article::where('title', 'like', '%'.$term.'%')->get();
        return $options->pluck('title', 'id');
    }

}
