<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\SliderInterface;
use App\Models\Slider;

class SliderRepository implements SliderInterface
{

    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function show($slider)
    {
        // TODO: Implement show() method.
    }

    public function edit($slider)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $slider)
    {
        // TODO: Implement update() method.
    }

    public function destroy($slider)
    {
        // TODO: Implement destroy() method.
    }
}
