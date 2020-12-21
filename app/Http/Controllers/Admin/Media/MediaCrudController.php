<?php

namespace App\Http\Controllers\Admin\Media;

use App\Models\File\Picture;
use App\Models\Media\Media;
use App\Support\Backpack\CustomForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Media\MediaRequest as StoreRequest;
use App\Http\Requests\Admin\Media\MediaRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class MediaCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class MediaCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Media\Media');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/media');
        $this->crud->setEntityNameStrings('СМИ о нас', 'СМИ о нас');
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
                'label' => 'Описание',
                'name' => 'description',
                'limit' => 70
            ],
            [
                'label' => 'Ссылка',
                'name' => 'link',
                'limit' => 70
            ],
            [
                'label' => 'Закреплён',
                'name' => 'fixed',
                'type' => 'checkbox_fixed'
            ]
        ]);

        $this->setFilters();

        // ------ CRUD FIELDS
        $this->crud->addField([
            'label' => 'Описание',
            'name' => 'description',
            'type' => 'text',
            'placeholder' => 'Введите описание',
        ]);
        $this->crud->addField([
            'label' => 'Картинка',
            'name' => 'image',
            'type' => 'browse'
        ]);
        $this->crud->addField([
            'label' => 'Ссылка (URL)',
            'name' => 'link',
            'type' => 'text',
        ]);
        $this->crud->addField([
            'name' => 'fixed',
            'label' => 'Закрепить',
            'type' => 'checkbox_fixed'
        ]);
    }

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
        $this->crud->addFilter(
            [ // select2_ajax filter
                'name' => 'description',
                'type' => 'select2_ajax',
                'label'=> 'Описание',
                'placeholder' => 'Выберите описание'
            ],
            url('admin/media/ajax-description-search'), // the ajax route
            function ($value) {
                // if the filter is active
                $this->crud->addClause('where', 'id', $value);
            }
        );

        $this->crud->addFilter(
            [
                'type' => 'select2_ajax',
                'name' => 'link',
                'label'=> 'Ссылка (URL)',
                'placeholder' => 'Выберите описание'
            ],
            url('admin/media/ajax-link-search'), // the ajax route
            function ($value) {
                // if the filter is active
                $this->crud->addClause('where', 'id', $value);
            }
        );
    }

    /**
     * Поиск по описанию
     *
     * @return mixed
     */
    public function descriptionSearch()
    {
        $term = $this->request->input('term');
        $media = Media::where('description', 'like', '%'.$term.'%')->get();
        return $media->pluck('description', 'id');
    }

    /**
     * Поиск по ссылке
     *
     * @return mixed
     */
    public function linkSearch()
    {
        $term = $this->request->input('term');
        $media = Media::where('link', 'like', '%'.$term.'%')->get();
        return $media->pluck('link', 'id');
    }
}
