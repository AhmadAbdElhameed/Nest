<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\BrandInterface;
use App\Http\Requests\Admin\Brand\StoreBrandRequest;
use App\Http\Requests\Admin\Brand\UpdateBrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{

    private $brandInterface;

    public function __construct(BrandInterface $brand)
    {
        $this->brandInterface = $brand;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->brandInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->brandInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        return $this->brandInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return $this->brandInterface->show($brand);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return $this->brandInterface->edit($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        return $this->brandInterface->update($request,$brand);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        return $this->brandInterface->destroy($brand);
    }
}
