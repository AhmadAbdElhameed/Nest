<?php

namespace App\Http\Interfaces\Admin;

interface OptionInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($option);

    public function edit($option);

    public function update( $request, $option);

    public function destroy($option);
}
