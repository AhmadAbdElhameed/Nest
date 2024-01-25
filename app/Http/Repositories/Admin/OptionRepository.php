<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\OptionInterface;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OptionRepository implements OptionInterface
{

    public function index()
    {
        $options = Option::with(['attribute' =>
            function ($query){
                $query->select('id');
            }, 'attribute' =>
            function ($attr){
            $attr->select('id');
        }
        ])->orderBy('id','DESC')->select('id','attribute_id','product_id','price')->paginate(PAGINATION_COUNT);
//        dd($options);
        return view('admin.options.index',compact('options'));
    }

    public function create()
    {
        $products = Product::active()->select('id')->get();
        $attributes = Attribute::select('id')->get();

        return view('admin.options.create',compact('attributes','products'));
    }

    public function store($request)
    {
//        dd($request->all());
        DB::beginTransaction();

        $option = Option::create([
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);

        $option->name = $request->name;
        $option->save();

        DB::commit();

        return redirect()->route('admin.option.index')->with(['success' => 'Done ']);
    }

    public function show($option)
    {
        // TODO: Implement show() method.
    }

    public function edit($option)
    {
        $products = Product::active()->select('id')->get();
        $attributes = Attribute::select('id')->get();
        return view('admin.options.edit',compact('option','attributes','products'));
    }

    public function update($request, $option)
    {
        DB::beginTransaction();

        $option->update([
            'attribute_id' => $request->attribute_id,
            'product_id' => $request->product_id,
            'price' => $request->price,
        ]);

        $option->name = $request->name;
        $option->save();

        DB::commit();

        return redirect()->route('admin.option.index')->with(['success' => 'Updated']);
    }

    public function destroy($option)
    {
        $option->delete();
        toast('Option Has Been Deleted Successfully!','success');
        return redirect()->back();
    }
}
