<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdminData;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class OrdersController extends Controller
{
    public function getDeliveryFee($prod_ids)
    {
        //let's calculate based on weight too
        $myProdArray = explode(',', $prod_ids);
        $data = AdminData::where('type', 'delivery_fee')->first();
        $fee = $data->price;

        $shop_arr = array();
        foreach ($myProdArray as $id) 
            {
                $product = Product::find($id);
                $shop_arr[] = array($product->shop_id);  
            } 
        $shop_id_single = call_user_func_array('array_merge', $shop_arr); 
        $uniqueArray = array_unique($shop_id_single);
        $total_shop = count($uniqueArray);

        $delivery_sum = $fee * $total_shop; 
        
        return response()->json(['amount' => $delivery_sum]);
    }
    
    public function getMyOrdersSummary(){
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();

        //step 1
        $orders = Order::where('user_id', $user->id)->latest()->get();

        $order_id = array();
        $singleProdIds = array();

        if($orders->count() > 0){
            foreach ($orders as $order) {
                $order_id_array[] = array($order->id);
            }
            $order_id = call_user_func_array('array_merge', $order_id_array); 
        }
        

        //step 2
        $ordersProds = OrderProduct::whereIn('order_id', $order_id)->get();

        //step 3
        if($ordersProds->count() > 0){
            foreach ($ordersProds as $prod) 
                {
                    $prodArray[] = array($prod->product_id);
                }
            $singleProdIds = call_user_func_array('array_merge', $prodArray);
        }
        $products = Product::whereIn('id', $singleProdIds)->get();

        //the summary
        $data = array();
        $data['orders'] = $orders;
        $data['ordersProds'] = $ordersProds;
        $data['products'] = $products;

        return json_encode($data);
    }
}
