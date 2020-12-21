<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Models\File\Picture;
use App\Models\Slider\Slider;
use App\Support\Backpack\CustomForm;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Slider\SliderRequest as StoreRequest;
use App\Http\Requests\Admin\Slider\SliderRequest as UpdateRequest;
use Exception;


/**
 * Class SliderCrudController
 *
 * @package App\Http\Controllers\Admin\Slider
 */
class SliderCrudController extends CrudController
{
    /**
     * SliderCrudController constructor.
     * @throws Exception
     */
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Slider::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/slider');
        $this->crud->setEntityNameStrings('Слайдер', 'Слайдер');
        $this->crud->query->orderBy('created_at', 'desc');

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
                'name' => 'name',
                'orderable' => true,
            ],
            [
                'label' => 'Сортировка',
                'name' => 'sort',
                'orderable' => true,
            ],
			[
				'label' => 'Ссылка',
				'name' => 'link',
				'type' => 'text',
                'orderable' => true,
			]
        ]);


        // ------ CRUD FIELDS
        $this->crud->addFields([
            [
                'label' => 'Название',
                'name' => 'name',
                'type' => 'text',
            ],
            [
                'label' => 'Сортировка',
                'name' => 'sort',
                'type' => 'position',
                'default' => 0
            ],
            [
                'label' => 'Ссылка',
                'name' => 'link',
                'type' => 'text',
            ],
            [
                'name' => 'image_desktop',
                'label' => 'Изображение для десктопа [555 x 390 px]',
                'type' => 'browse_slider_desktop',
            ],
            [
                'name' => 'image_mobile',
                'label' => 'Изображение для мобильной версии [270 x 328 px]',
                'type' => 'browse_slider_mobile',
            ]
        ]);

        $this->crud->enableAjaxTable();
        $this->crud->disableResponsiveTable();

    }

    /**
     * Создает model включая кастомную колонку
     * @param StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $item = CustomForm::updateForSlider(
            $this->crud,
            Picture::class,
            [
                'image_desktop' => 'picture_desktop_id',
                'image_mobile' => 'picture_mobile_id'
            ]
        );

        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        return $this->performSaveAction($item->id);
    }

    /**
     * Обновляет model включая кастомную колонку
     * @param UpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request)
    {
        CustomForm::updateForSlider(
            $this->crud,
            Picture::class,
            [
                'image_desktop' => 'picture_desktop_id',
                'image_mobile' => 'picture_mobile_id'
            ]);

        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return $this->performSaveAction($request->id);
    }
}
