<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\CategoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryInterface
{

    public function index()
    {
        $categories = Category::orderBy('id','DESC')->parent()->paginate(PAGINATION_COUNT);
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        Category::create([
            'name' => $request->name,
            'status' => $request->status,
        ]);

        toast('Category Success','success');
        return redirect()->route('admin.category.index');
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
       $category->update([
           'name' => $request->name,
           'status' => $status,
       ]);

       toast('Category Success','success');
       return redirect()->route('admin.category.index');
    }

    public function destroy($category)
    {
        // TODO: Implement destroy() method.
    }
}
