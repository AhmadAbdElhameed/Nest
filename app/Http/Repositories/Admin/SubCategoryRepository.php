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

//        dd($request->all());
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
        // TODO: Implement edit() method.
    }

    public function update($request, $subCategory)
    {
        // TODO: Implement update() method.
    }

    public function destroy($subCategory)
    {
        // TODO: Implement destroy() method.
    }
}
