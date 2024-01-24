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
        return view('admin.attributes.edit',compact('attribute'));
    }

    public function update($request, $attribute)
    {
        try {
            DB::beginTransaction();

            //save Translation

            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();

            return redirect()->route('admin.attribute.index')->with(['success' => 'Updated !!!!']);
        }
        catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.attribute.index')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($attribute)
    {
        $attribute->delete();
        toast('Attribute Deleted Successfully!' , 'success');
        return redirect()->back()->with(['success' => 'deleted successfully!']);
    }
}
