<?php

namespace App\Http\Interfaces\Admin;

interface TagInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($tag);

    public function edit($tag);

    public function update($request,$tag);

    public function destroy($tag);
}
