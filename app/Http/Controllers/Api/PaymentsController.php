<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Tymon\JWTAuth\Facades\JWTAuth;

class PaymentsController extends Controller
{
    public function appPayment(Request $request)
    {
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();

        // $metadata = json_decode($request->data);
        // return $metadata->type;
        $metadata = $request;
        // dd(json_decode($request->data, true));
        
        $TotalPaid = $metadata->total;
        $altaddress = $metadata->altaddress;
        if ($altaddress == NULL) 
            {
                $mainAddress = $metadata->address;
            }else
                {
                    $mainAddress = $altaddress;
                }
        
        
        //Insert into orders table
            $order = Order::create([
                'user_id' => $user->id,
                'user_email' => $user->email, 
                'user_name' => $user->name, 
                'user_address' => $mainAddress, 
                'user_phone' => $user->phone, 
                'delivery_fee' => $metadata->delivery_fee, 
                'subtotal' => $TotalPaid - $metadata->delivery_fee,
                'total' => $TotalPaid,
            ]);
            
            $productId = $metadata->product_id;
            $productQty = $metadata->product_qty;
            
            // dd($productId);
            $countItem = count($productId);
            //to insert data into order_product table

            for ($h=0; $h < $countItem; $h++) 
                { 
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $productId[$h],
                        'quantity' => $productQty[$h],
                    ]);

                    Rating::create([
                        'order_id' => $order->id,
                        'user_id' => $user->id,
                        'user_email' => $user->email,
                        'product_id' => $productId[$h],
                        'token' => 'rating'.time().'token'.$productId[$h],
                    ]);
                }    




         //this is to send message to the admin and to the customer
        //$customerPhone = $paymentDetails['data']['metadata']['phone'] + 0;
        // include 'sms.php';

        //Mail::send(new OrderPlaced($order));
        // OrderEmailJob::dispatch($order)->delay(now()->addSeconds(2));
        Mail::send(new OrderMail($order));
        
        return response()->json(["message" => true ]);
    }
}
