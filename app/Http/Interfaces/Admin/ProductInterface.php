<?php

namespace App\Http\Interfaces\Admin;

interface ProductInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($product);

    public function edit($product);

    public function update($request,$product);

    public function destroy($product);

    public function getPrice($product);

    public function updatePrice($request,$product);

    public function getInventory($product);

    public function updateInventory($request, $product);

    public function getImages($product);

    public function updateImages( $request,$product);
}
