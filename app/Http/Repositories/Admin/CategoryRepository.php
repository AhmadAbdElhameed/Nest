<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\CategoryInterface;
use App\Http\Traits\ImageUploadTrait;
use App\Models\Category;

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
        $status = $request->has('status') ? 1 : 0;
        $image = $this->uploadImage($request,'image',$this->categoryModel::PATH);
//        dd($image);
        Category::create([
            'name' => $request->name,
            'status' => $status,
            'slug' => $request->slug,
            'image' => $image
        ]);

        toast('Category created','success');
        return redirect()->route('admin.category.index')->with(['success' => 'Done !']);
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
       $status = $request->has('status') ? 1 : 0;
        if($request->image){
            $image = $this->updateAnyImage($request,'image',$this->categoryModel::PATH,$category->image);
        }

       $category->update([
           'name' => $request->name,
           'status' => $status,
           'slug' => $request->slug,
           'image' => $image
       ]);

       toast('Category Success','success');
       return redirect()->route('admin.category.index');
    }

    public function destroy($category)
    {
        $this->deleteImage($category->image);
        $category->delete();
        toast('Category Deleted Successfully!','success');
        return redirect()->back();
    }
}
