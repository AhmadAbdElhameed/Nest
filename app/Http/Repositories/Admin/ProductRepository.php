<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\ProductInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductRepository implements ProductInterface
{

    public function index()
    {
        $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        $data = [];
        $data['brands'] = Brand::where('status',1)->select('id')->get();
        $data['tags'] = Tag::select('id')->get();
        $data['categories'] = Category::active()->select('id')->get();
//        dd($data);
        return view('admin.product.create', $data);
    }

    public function store($request)
    {
        DB::beginTransaction();

        //validation

        if (!$request->has('status'))
            $request->request->add(['status' => 0]);
        else
            $request->request->add(['status' => 1]);

        if (!$request->has('manage_stock'))
            $request->request->add(['manage_stock' => 0]);
        else
            $request->request->add(['manage_stock' => 1]);

        if (!$request->has('in_stock'))
            $request->request->add(['in_stock' => 0]);
        else
            $request->request->add(['in_stock' => 1]);

        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'status' => $request->status,
            'price' => $request->price,
            'manage_stock' => $request->manage_stock,
            'in_stock' => $request->in_stock,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        //save product categories

        $product->categories()->attach($request->categories);

        //save product tags

        $product->tags()->attach($request->tags);

        DB::commit();
        return redirect()->route('admin.product.index')->with(['success' => 'تم ألاضافة بنجاح']);
    }

    public function show($product)
    {
        // TODO: Implement show() method.
    }

    public function edit($product)
    {
        // TODO: Implement edit() method.
    }

    public function update($request, $product)
    {
        // TODO: Implement update() method.
    }

    public function destroy($product)
    {
        // TODO: Implement destroy() method.
    }

    public function getPrice($product)
    {
        return view('admin.product.price.edit',compact('product'));
    }

    public function updatePrice($request,$product)
    {

        try{
            $product->update([
                'price' => $request->price,
                'special_price' => $request->special_price,
                'special_price_type' => $request->special_price_type,
                'special_price_start' => $request->special_price_start,
                'special_price_end' => $request->special_price_end,
            ]);
            return redirect()->route('admin.product.index')->with(['success' => 'done']);
        }catch(\Exception $exception){

        }
    }

    public function getInventory($product)
    {
        return view('admin.product.inventory.edit',compact('product'));
    }

    public function updateInventory($request, $product)
    {

        DB::beginTransaction();

        if (!$request->has('manage_stock'))
            $request->request->add(['manage_stock' => 0]);
        else
            $request->request->add(['manage_stock' => 1]);

        if (!$request->has('in_stock'))
            $request->request->add(['in_stock' => 0]);
        else
            $request->request->add(['in_stock' => 1]);

        $product->update([
            'sku' => $request->sku,
            'manage_stock' => $request->manage_stock,
            'in_stock' => $request->in_stock,
            'qty' => $request->qty
        ]);

        DB::commit();
        return redirect()->route('admin.product.index')->with(['success' => 'تم ألاضافة بنجاح']);
    }

    public function getImages($product)
    {
        return view('admin.product.image.edit',compact('product'));
    }

    public function updateImages($request, $product)
    {
        $uploadedImages = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = $image->getClientOriginalName();
                $destinationPath = public_path('uploads/images');
                $image->move($destinationPath, $filename);
                $uploadedImages[] = url('uploads/images/' . $filename);
            }
        }

        return response()->json(['uploadedImages' => $uploadedImages]);
    }

    public function destroyImage($request)
    {
        $url = $request->input('url');
        $filename = basename(parse_url($url, PHP_URL_PATH));

        // Delete the file from public/uploads/images
        File::delete(public_path('uploads/images/' . $filename));

        // Respond with success
        return response()->json(['success' => 'Image removed']);
    }
}
