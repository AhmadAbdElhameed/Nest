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
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function show($tag)
    {
        // TODO: Implement show() method.
    }

    public function edit($tag)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $tag)
    {
        // TODO: Implement update() method.
    }

    public function destroy($tag)
    {
        // TODO: Implement destroy() method.
    }
}
