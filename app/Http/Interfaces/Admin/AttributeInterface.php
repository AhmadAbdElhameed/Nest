<?php

namespace App\Http\Interfaces\Admin;

interface AttributeInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($attribute);

    public function edit($attribute);

    public function update($request, $attribute);

    public function destroy($attribute);
}
