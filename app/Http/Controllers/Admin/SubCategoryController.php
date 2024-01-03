<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SubCategoryInterface;
use App\Http\Requests\Admin\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\Admin\SubCategory\UpdateSubCategoryRequest;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    private $subCategoryInterface;

    public function __construct(SubCategoryInterface $subCategory)
    {
        $this->subCategoryInterface = $subCategory;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->subCategoryInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->subCategoryInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubCategoryRequest $request)
    {
        return $this->subCategoryInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        return $this->subCategoryInterface->edit($subCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSubCategoryRequest $request, SubCategory $subCategory)
    {
        return $this->subCategoryInterface->update($request,$subCategory);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCategory $subCategory)
    {
        return $this->subCategoryInterface->destroy($subCategory);
    }
}
