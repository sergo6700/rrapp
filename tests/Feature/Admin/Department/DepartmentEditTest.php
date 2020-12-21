<?php


namespace Tests\Feature\Admin\Department;

use App\Models\Division\Division;

/**
 * Class DepartmentEditTest
 *
 * @coversDefaultClass \App\Http\Controllers\Admin\Division\DivisionCrudController
 * @package Tests\Feature\Admin\Department
 */
class DepartmentEditTest extends AbstractDepartmentTest
{
    /**
     * Check successful page opening
     *
     * @covers \App\Http\Controllers\Admin\Division\DivisionCrudController::edit
     * @test
     * @return void
     */
    public function checkSuccessfulPageOpening() :void
    {
        $this->successLogIn();

        $division = Division::where($this->department_data)->first();
        $response = $this->get(route('crud.department.edit', ['id' => $division->id]));

        $response->assertOk();
        $response->assertViewIs("crud::edit");
    }
}