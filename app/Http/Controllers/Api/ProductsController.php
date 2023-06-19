<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Section;
use App\Models\Shop;
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

    public function productSearch(Request $request){
        $data = json_decode($request->data);
        // $data = (object)$request->data;
        $item = $data->item;
        
         $products = Product::search($item, null, true); 

         $products = $products->where('active', 1)->where('deleted', 0)->latest()->get();

         return response()->json($products);
    }

    public function productDetails($id){
        $product = Product::where('id', $id)->where('active', 1)->where('deleted', 0)->first();

        $caty = Section::find($product->section_id);
        $shop = Shop::find($product->shop_id);

        $ratings = Rating::where('product_id', $id)->where('remit', 1)->get();
        
        $similars = Product::where('shop_id', $product->shop_id)->where('id', '!=', $id)->where('active', 1)->where('deleted', 0)->get();

        return response()->json([
            'message' => 'success',
            'sectionName' => $caty->title,
            'shopName' => $shop->name,
            'ratings' => $ratings,
            'similars' => $similars,
        ]);

    }
}
