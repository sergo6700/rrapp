<?php
namespace App\Http\Controllers\Admin\Email;

use App\Models\Email\EmailTemplate;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use App\Http\Requests\Admin\Email\EmailTemplateCrudRequest as StoreRequest;
use App\Http\Requests\Admin\Email\EmailTemplateCrudRequest as UpdateRequest;
use Exception;
use Illuminate\Http\RedirectResponse;

/**
 * Class EmailTemplateCrudController
 * @package App\Http\Controllers\Admin\Email
 */
class EmailTemplateCrudController extends CrudController
{
    /**
     * EmailTemplateCrudController constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Setup crud model
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
        $this->crud->setModel(EmailTemplate::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/email-template');
        $this->crud->setEntityNameStrings('шаблон', 'e-mail шаблоны');

        $templates_types = config('handbook.email_template_types');
        $types = array_column($templates_types, 'name', 'id');

        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->setColumns($types);
        $this->setFields($types);
    }

    /**
     * Set table list columns
     *
     * @param $types
     * @return void
     */
    public function setColumns(array $types)
    {
        $this->crud->setColumns([
            [
                'label' => 'Название шаблона',
                'type' => 'text',
                'name' => 'name',
                'searchLogic' => true,
            ],
            [
                'name' => 'type_id',
                'label' => 'Тип',
                'type' => 'select_from_array',
                'options' => $types,
            ],
        ]);
    }

    /**
     * Set form fields
     * @param array $types
     */
    public function setFields(array $types)
    {

        $this->crud->addFields([
            [
                'label' => 'Название',
                'type' => 'text',
                'name' => 'name'
            ],
            [   // select_from_array
                'name' => 'type_id',
                'label' => 'Тип',
                'type' => 'select2_from_array',
                'options' => $types,
                'allows_null' => false,
            ],
            [
                'label' => 'Содержимое',
                'type' => 'wysiwyg',
                'name' => 'content'
            ],
        ]);
    }

    /**
     * Save request on create
     *\
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return $this->storeCrud();
    }

    /**
     * Save request on edit
     *
     * @param UpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request): RedirectResponse
    {
        return $this->updateCrud();
    }

}
