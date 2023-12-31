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

            toast(__('admin/category.create_success'),'success');
            return redirect()->route('admin.category.index')->with(['success' => __('admin/category.create_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.category.index')->with(['error' => __('admin/category.failed_message')]);
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
                return redirect()->route('admin.category.index')->with(['error' => __('admin/category.not_exist')]);

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

            toast(__('admin/category.update_success'),'success');
            return redirect()->route('admin.category.index')->with(['success' => __('admin/category.update_success')]);
        } catch (\Exception $ex) {
            toast(__('admin/category.failed_message'),'error');
            return redirect()->route('admin.category.index')->with(['error' => __('admin/category.failed_message')]);
        }

    }

    public function destroy($category)
    {
        $this->deleteImage($category->image);
        $category->delete();
        toast(__('admin/category.delete_success'),'success');
        return redirect()->back();
    }
}
