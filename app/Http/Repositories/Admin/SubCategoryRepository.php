<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\SubCategoryInterface;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryRepository implements SubCategoryInterface
{

    use imageUploadTrait;

    private $subCategoryModel;

    public function __construct(SubCategory $subCategory)
    {
        $this->subCategoryModel = $subCategory;
    }

    public function index()
    {
        $subCategories = SubCategory::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.sub-category.index',compact('subCategories'));
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

            toast('Success ','success');
            return redirect()->route('admin.sub-category.index')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.sub-category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
                return redirect()->route('admin.sub-category.index')->with(['error' => 'هذا القسم غير موجود']);

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

            toast('Success ','success');
            return redirect()->route('admin.sub-category.index')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.sub-category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($subCategory)
    {
        $this->deleteImage($subCategory->image);
        $subCategory->delete();
        toast('SubCategory Deleted Successfully!','success');
        return redirect()->back();
    }
}
