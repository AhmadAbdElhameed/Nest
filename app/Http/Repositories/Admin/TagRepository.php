<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\TagInterface;
use App\Models\Tag;

class TagRepository implements TagInterface
{

    public function index()
    {
        $tags = Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.tag.index',compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store($request)
    {
        try {

            $category = Tag::create([
                'slug' => $request->slug,
            ]);

            //save translations
            $category->name = $request->name;
            $category->save();

            toast( __('admin/tag.create_success'),'success');
            return redirect()->route('admin.tag.index')->with(['success' => __('admin/tag.create_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.tag.index')->with(['error' => __('admin/tag.failed_message')]);
        }
    }

    public function show($tag)
    {
        // TODO: Implement show() method.
    }

    public function edit($tag)
    {
        return view('admin.tag.edit',compact('tag'));
    }

    public function update($request, $tag)
    {
        try {
            if (!$tag)
                return redirect()->route('admin.tag.index')->with(['error' => __('admin/tag.not_exist')]);

            $tag->update($request->all());

            //save translations
            $tag->name = $request->name;
            $tag->save();

            toast( __('admin/tag.update_success'),'success');
            return redirect()->route('admin.tag.index')->with(['success' => __('admin/tag.update_success')]);
        } catch (\Exception $ex) {
            toast('Failed ','error');
            return redirect()->route('admin.tag.index')->with(['error' => __('admin/tag.failed_message')]);
        }
    }

    public function destroy($tag)
    {
        // TODO: Implement destroy() method.
    }
}
