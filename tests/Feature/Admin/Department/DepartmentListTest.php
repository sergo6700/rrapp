<?php


namespace Tests\Feature\Admin\Department;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class DepartmentListTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Division\DivisionCrudController
 * @package Tests\Feature\Admin\Department
 */
class DepartmentListTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Division\DivisionCrudController::index
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.department.index'));

        $response->assertOk();
        $response->assertViewIs("crud::list");
    }
}