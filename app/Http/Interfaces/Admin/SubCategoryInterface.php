<?php

namespace App\Http\Interfaces\Admin;

interface SubCategoryInterface
{

    public function index();

    public function create();

    public function store($request);

    public function edit($subCategory);

    public function update($request, $subCategory);

    public function destroy($subCategory);
}
