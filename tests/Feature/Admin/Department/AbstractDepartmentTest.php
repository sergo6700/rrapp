<?php


namespace Tests\Feature\Admin\Department;

use App\Models\Division\Division;
use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class AbstractDepartmentTest
 * @package Tests\Feature\Admin\Department
 */
abstract class AbstractDepartmentTest extends AdminLoginTest
{
    /**
     * Example department data
     *
     * @var array $department_data
     */
    protected $department_data = [
      'name' => 'Центры «Мой бизнес»',
      'content' => 'Центры «Мой бизнес» созданы по инициативе Минэкономразвития в рамках нацпроекта «Малое и среднее предпринимательство и поддержка индивидуальной предпринимательской инициативы».',
    ];

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp() :void
    {
        parent::setUp();

        Division::create($this->department_data);

        $this->assertDatabaseHas((new Division())->getTable(),
            $this->department_data
        );
    }
}