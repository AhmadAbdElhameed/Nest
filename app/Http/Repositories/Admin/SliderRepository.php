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
        try {

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
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.slider.index')->with(['error' => __('admin/brand.failed_message')]);
        }
    }

    public function show($slider)
    {
        // TODO: Implement show() method.
    }

    public function edit($slider)
    {
        return view('admin.slider.edit',compact('slider'));
    }

    public function update($request, $slider)
    {
//        dd($request->all());
        try {
            if (!$slider)
                return redirect()->route('admin.slider.index')->with(['error' => __('admin/brand.not_exist')]);

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            if($request->image){
                $image = $this->updateAnyImage($request,'image',$this->sliderModel::PATH,$slider->image);
            }

            $slider->update([
                'slug' => $request->slug,
                'status' => $request->status,
                'image' => $image ?? $slider->image,
            ]);

            //save translations
            $slider->title = $request->title;
            $slider->sub_title = $request->sub_title;
            $slider->save();

            toast( __('admin/brand.update_success'),'success');
            return redirect()->route('admin.slider.index')->with(['success' => __('admin/brand.update_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.slider.index')->with(['error' => __('admin/brand.failed_message')]);
        }
    }

    public function destroy($slider)
    {
        $this->deleteImage($slider->image);
        $slider->delete();
        toast(__('admin/brand.delete_success'),'success');
        return redirect()->back();
    }
}
