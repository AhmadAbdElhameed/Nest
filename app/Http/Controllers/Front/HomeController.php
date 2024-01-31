<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Front\HomeInterface;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $homeInterface;

    public function __construct(HomeInterface $home)
    {
        $this->homeInterface = $home;
    }

    public function home(){
        return $this->homeInterface->home();
    }
    public function category(Category $category){
        return $this->homeInterface->category($category);
    }
    public function productDetails(Product $product){
        return $this->homeInterface->productDetails($product);
    }
}
