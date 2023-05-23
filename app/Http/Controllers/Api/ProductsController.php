<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function all(){

        $products = Product::where('active', 1)->where('deleted', 0)->latest()->get();

        return json_encode($products);
    }

    public function single($id){
        $product = Product::where('id', $id)->where('active', 1)->where('deleted', 0)->first();

        return json_encode($product);
    }

    public function sectionProducts($section_id){
        $products = Product::where('section_id', $section_id)
                            ->where('active', 1)
                            ->where('deleted', 0)
                            ->latest()
                            ->get();

        return json_encode($products);
    }

    public function shopProducts($shop_id){
        $products = Product::where('shop_id', $shop_id)
                            ->where('active', 1)
                            ->where('deleted', 0)
                            ->latest()
                            ->get();

        return json_encode($products);
    }
}
