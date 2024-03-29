<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Admin\ProductInterface;
use App\Http\Requests\Admin\Product\StoreProductPriceRequest;
use App\Http\Requests\Admin\Product\StoreProductRequest;
use App\Http\Requests\Admin\Product\UpdateProductImagesRequest;
use App\Http\Requests\Admin\Product\UpdateProductInventoryRequest;
use App\Http\Requests\Admin\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productInterface;

    public function __construct(ProductInterface $product)
    {
        $this->productInterface = $product;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->productInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->productInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return $this->productInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->productInterface->show($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return $this->productInterface->edit($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        return $this->productInterface->update($request,$product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        return $this->productInterface->destroy($product);
    }

    public function getPrice(Product $product)
    {
        return $this->productInterface->getPrice($product);
    }
    public function updatePrice(StoreProductPriceRequest $request,Product $product)
    {
        return $this->productInterface->updatePrice($request,$product);
    }

    public function getInventory(Product $product)
    {
        return $this->productInterface->getInventory($product);
    }
    public function updateInventory(UpdateProductInventoryRequest $request,Product $product)
    {
        return $this->productInterface->updateInventory($request,$product);
    }
    public function getImages(Product $product)
    {
        return $this->productInterface->getImages($product);
    }
    public function updateImages(UpdateProductImagesRequest $request,Product $product)
    {
        return $this->productInterface->updateImages($request,$product);
    }
    public function destroyImage($id)
    {
        return $this->productInterface->destroyImage($id);
    }

}
