<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\BrandInterface;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Brand;

class BrandRepository implements BrandInterface
{

    use imageUploadTrait;

    private $brandModel;

    public function __construct(Brand $brand)
    {
        $this->brandModel = $brand;
    }

    public function index()
    {
        $brands = Brand::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.brand.index',compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store($request)
    {

        try {

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $image = $this->uploadImage($request,'image',$this->brandModel::PATH);

            $category = Brand::create([
                'slug' => $request->slug,
                'status' => $request->status,
            ]);

            //save translations
            $category->name = $request->name;
            $category->image = $image;
            $category->save();

            toast( __('admin/brand.create_success'),'success');
            return redirect()->route('admin.brand.index')->with(['success' => __('admin/brand.create_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.brand.index')->with(['error' => __('admin/brand.failed_message')]);
        }
    }

    public function edit($brand)
    {
        return view('admin.brand.edit',compact('brand'));
    }

    public function update($request, $brand)
    {
//        dd($request->all());
        try {
            if (!$brand)
                return redirect()->route('admin.brand.index')->with(['error' => __('admin/brand.not_exist')]);

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            if($request->image){
                $image = $this->updateAnyImage($request,'image',$this->brandModel::PATH,$brand->image);
            }

            $brand->update($request->all());

            //save translations
            $brand->name = $request->name;
            $brand->image = $image ?? $brand->image;
            $brand->save();

            toast( __('admin/brand.update_success'),'success');
            return redirect()->route('admin.brand.index')->with(['success' => __('admin/brand.update_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.brand.index')->with(['error' => __('admin/brand.failed_message')]);
        }
    }

    public function destroy($brand)
    {
        $this->deleteImage($brand->image);
        $brand->delete();
        toast(__('admin/brand.delete_success'),'success');
        return redirect()->back();
    }

    public function show($brand)
    {
        // TODO: Implement show() method.
    }
}
