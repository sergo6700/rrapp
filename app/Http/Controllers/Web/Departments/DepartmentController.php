<?php

namespace App\Http\Controllers\Web\Departments;

use App\Http\Controllers\Controller;
use App\Models\Division\Division;
use App\Models\PageMetadata\PageMetadata;
use App\Services\Web\DepartmentService;
use App\Services\Web\SeoService;
use Illuminate\View\View;

/**
 * Class DepartmentController
 *
 * @package App\Http\Controllers\Web\Departments
 */
class DepartmentController extends Controller
{
    /**
     * Department service instance
     *
     * @var DepartmentService
     */
    protected $department_service;

    /**
     * SeoService Instance
     *
     * @var SeoService
     */
    protected $seo_service;

    /**
     * DepartmentController constructor.
     *
     * @param DepartmentService $department_service DepartmentService Instance
     * @param SeoService        $seo_service        SeoService Instance
     */
    public function __construct(DepartmentService $department_service, SeoService $seo_service)
    {
        $this->department_service = $department_service;
        $this->seo_service = $seo_service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \ReflectionException
     */
    public function index(): View
    {
        $items = $this->department_service->index();
        $metaData = $this->seo_service->load(PageMetadata::DEPARTMENTS_ALIAS, $items);

        return view(
            'web.departments.index'
        )->with(
            [
                'items' => $items,
                'title' =>  $metaData->title,
                'description' =>  $metaData->description,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param Division $slug Model
     *
     * @return View
     */
    public function show(Division $slug): View
    {
        $department = $this->department_service->load($slug);

        return view('web.departments.show', compact('department'));
    }

}
