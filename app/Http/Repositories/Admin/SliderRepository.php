<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\SliderInterface;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Slider;

class SliderRepository implements SliderInterface
{

    use imageUploadTrait;

    private $brandModel;

    public function __construct(Slider $slider)
    {
        $this->sliderModel = $slider;
    }
    public function index()
    {
        $sliders = Slider::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.slider.index',compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store($request)
    {
//        try {

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $image = $this->uploadImage($request,'image',$this->sliderModel::PATH);

            $slider = Slider::create([
                'slug' => $request->slug,
                'status' => $request->status,
                'image' => $image,
            ]);

            //save translations
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;

            $slider->save();

            toast( __('admin/brand.create_success'),'success');
            return redirect()->route('admin.slider.index')->with(['success' => __('admin/brand.create_success')]);
//        } catch (\Exception $ex) {
//            toast('Failed ','error');
//            return redirect()->route('admin.slider.index')->with(['error' => __('admin/brand.failed_message')]);
//        }
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
