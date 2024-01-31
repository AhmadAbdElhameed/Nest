<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Requests\Admin\Slider\StoreSliderRequest;
use App\Http\Requests\Admin\Slider\UpdateSliderRequest;
use App\Models\Slider;

class SliderController extends Controller
{
    private $sliderInterface;

    public function __construct(SliderInterface $slider)
    {
        $this->sliderInterface = $slider;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->sliderInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->sliderInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSliderRequest $request)
    {
        return $this->sliderInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return $this->sliderInterface->show($slider);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return $this->sliderInterface->edit($slider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        return $this->sliderInterface->update($request,$slider);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        return $this->sliderInterface->destroy($slider);
    }
}
