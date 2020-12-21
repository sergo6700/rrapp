<?php


namespace Tests\Feature\Admin\Department;

use Tests\Feature\Admin\AdminLoginTest;

/**
 * Class DepartmentCreateTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Division\DivisionCrudController
 * @package Tests\Feature\Admin\Department
 */
class DepartmentCreateTest extends AdminLoginTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Division\DivisionCrudController::create
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $response = $this->get(route('crud.department.create'));

        $response->assertOk();
        $response->assertViewIs("crud::create");
    }
}