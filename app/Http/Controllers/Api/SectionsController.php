<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Section;
use App\Models\Shop;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    //

    public function index(){
        $sections = Section::all();

        return json_encode($sections);
    }

    public function shops($section_id){
        $shops = Shop::where('section_id', $section_id)->where('active', 1)->latest()->get();

        return json_encode($shops);
    }

    public function banners(){
        $banners = Banner::where('title', '!=', NULL)->latest()->get();

        return response()->json($banners);
    }

    public function flashSales(){
        $products = Product::where('boosted', 1)->where('active', 1)->get();

        return response()->json($products);
    }

    public function stillAvailable(){
        $products = Product::where('active', 1)->latest()->get();

        return response()->json($products);
    }

    
}
