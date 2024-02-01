<?php

namespace App\Http\Interfaces\Front;

interface HomeInterface
{

    public function home();

    public function category($category);

    public function productDetails($product);

    public function showModalContent($id);
}
