<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Shop;
use App\Models\Product;
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

    
}
