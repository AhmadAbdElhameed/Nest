<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryRepository implements CategoryInterface
{
    use imageUploadTrait;

    private $categoryModel;

    public function __construct(Category $category)
    {
        $this->categoryModel = $category;
    }

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->parent()->paginate(PAGINATION_COUNT);
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store($request)
    {

        try {

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            $image = $this->uploadImage($request,'image',$this->categoryModel::PATH);

            $category = Category::create([
                'slug' => $request->slug,
                'status' => $request->status,
            ]);

            //save translations
            $category->name = $request->name;
            $category->image = $image;
            $category->save();

            toast('Success ','success');
            return redirect()->route('admin.category.index')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($category)
    {
        // TODO: Implement show() method.
    }

    public function edit($category)
    {
        return view('admin.category.edit',compact('category'));
    }

    public function update($request, $category)
    {

        try {
            if (!$category)
                return redirect()->route('admin.category.index')->with(['error' => 'هذا القسم غير موجود']);

            if (!$request->has('status'))
                $request->request->add(['status' => 0]);
            else
                $request->request->add(['status' => 1]);

            if($request->image){
                $image = $this->updateAnyImage($request,'image',$this->categoryModel::PATH,$category->image);
            }

            $category->update($request->all());

            //save translations
            $category->name = $request->name;
            $category->image = $image ?? $category->image;
            $category->save();

            toast('Success ','success');
            return redirect()->route('admin.category.index')->with(['success' => 'تم ألتحديث بنجاح']);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.category.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($category)
    {
        $this->deleteImage($category->image);
        $category->delete();
        toast('Category Deleted Successfully!','success');
        return redirect()->back();
    }
}
