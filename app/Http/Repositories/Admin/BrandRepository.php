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

        $categories = Category::where('status',1)->get();
//        dd($categories);
        return view('admin.sub-category.create',compact('categories'));
    }

    public function store($request)
    {

        try {

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $image = $this->uploadImage($request,'image',$this->subCategoryModel::PATH);

            $category = SubCategory::create([
                'slug' => $request->slug,
                'status' => $request->status,
                'category_id' => $request->category_id,
            ]);

            //save translations
            $category->name = $request->name;
            $category->image = $image;
            $category->save();

            toast( __('admin/sub_category.create_success'),'success');
            return redirect()->route('admin.sub-category.index')->with(['success' => __('admin/sub_category.create_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.sub-category.index')->with(['error' => __('admin/sub_category.failed_message')]);
        }
    }

    public function edit($subCategory)
    {
        $categories = Category::where('status',1)->get();
        return view('admin.sub-category.edit',compact('subCategory','categories'));
    }

    public function update($request, $subCategory)
    {
//        dd($request->all());
        try {
            if (!$subCategory)
                return redirect()->route('admin.sub-category.index')->with(['error' => __('admin/sub_category.not_exist')]);

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            if($request->image){
                $image = $this->updateAnyImage($request,'image',$this->subCategoryModel::PATH,$subCategory->image);
            }

            $subCategory->update($request->all());

            //save translations
            $subCategory->name = $request->name;
            $subCategory->image = $image ?? $subCategory->image;
            $subCategory->save();

            toast( __('admin/sub_category.update_success'),'success');
            return redirect()->route('admin.sub-category.index')->with(['success' => __('admin/sub_category.update_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.sub-category.index')->with(['error' => __('admin/sub_category.failed_message')]);
        }
    }

    public function destroy($subCategory)
    {
        $this->deleteImage($subCategory->image);
        $subCategory->delete();
        toast(__('admin/sub_category.delete_success'),'success');
        return redirect()->back();
    }

    public function show($brand)
    {
        // TODO: Implement show() method.
    }
}
