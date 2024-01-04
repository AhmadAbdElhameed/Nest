<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    private $categoryInterface;

    public function __construct(CategoryInterface $category)
    {
        $this->categoryInterface = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->categoryInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->categoryInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        return $this->categoryInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->categoryInterface->show($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return $this->categoryInterface->edit($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        return $this->categoryInterface->update($request,$category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->categoryInterface->destroy($category);
    }
}
