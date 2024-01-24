<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\AttributeInterface;
use App\Models\Attribute;
use Illuminate\Support\Facades\DB;

class AttributeRepository implements AttributeInterface
{

    public function index()
    {
        $attributes = Attribute::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        return view('admin.attributes.index',compact('attributes'));
    }

    public function create()
    {
        return view('admin.attributes.create');
    }

    public function store($request)
    {
        DB::beginTransaction();

        $attribute =Attribute::create([]);

        //save Translation

        $attribute->name = $request->name;
        $attribute->save();

        DB::commit();

        return redirect()->route('admin.attribute.index')->with(['success' => 'Done !!!!']);
    }

    public function show($attribute)
    {
        // TODO: Implement show() method.
    }

    public function edit($attribute)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $attribute)
    {
        // TODO: Implement update() method.
    }

    public function destroy($attribute)
    {
        // TODO: Implement destroy() method.
    }
}
