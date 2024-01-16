<?php

namespace App\Http\Repositories\Admin;

use App\Http\Interfaces\Admin\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{

    public function index()
    {
        $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('admin.product.index', compact('products'));
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
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
}
