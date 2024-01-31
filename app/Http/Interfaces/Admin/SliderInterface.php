<?php

namespace App\Http\Interfaces\Admin;

interface SliderInterface
{

    public function index();

    public function create();

    public function store($request);

    public function show($slider);

    public function edit($slider);

    public function update($request, $slider);

    public function destroy($slider);
}
