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
        // TODO: Implement edit() method.
    }

    public function update($request, $option)
    {
        // TODO: Implement update() method.
    }

    public function destroy($option)
    {
        // TODO: Implement destroy() method.
    }
}
