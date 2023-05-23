<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Order Confirmation - [#ZS{{$order->id}}]</title>
</head>
<?php

use App\Models\OrderProduct;
$order_details = OrderProduct::where('order_id', $order->id)->get();
?>
<body>
	<div class="card" style="background-color: lightgrey;">
		<span class="text-center">
			<img src="{{config('app.url')}}/img/logo.png" style="width: 100px;">
		</span>
	  <div class="container card-body" style="background-color: white; margin-top: 50px; ">
	    <h3>Dear {{$order->user_name}},</h3>
		
	    <p>Thank you for placing your order with {{config('app.name')}}. We are excited to confirm that your order has been received and is being processed. Please review the details of your order below:</p>
	    <p>
	    	Order Number: #ZS{{$order->id}} <br>
			Order Date: {{$order->created_at}}<br>
			Shipping Address: {{$order->user_address}}<br>

			Order Details:<br>
			@if($order_details->count() > 0)
			@foreach($order_details as $detail)
				{{getProduct($detail->product_id)->title}} - {{$detail->quantity}}X <br>
			@endforeach
			@endif

			Total Amount: &#8358;{{ number_format($order->total) }} <br>

	    </p>

	    <p>
	    	We are currently working on preparing your order for shipment. You will receive another email notification once your order has been dispatched along with the tracking details. <br>

			If you have any questions or need further assistance, please feel free to contact our customer support team at <a href="tel:+2348131649219">+2348131649219</a>. We are always here to help. <br>

			Thank you for choosing {{config('app.name')}}. We appreciate your business and look forward to serving you again in the future.
	    </p>
						
	    <p>
	    	<b>Best Regards!!</b> <br> 
	    	<b>{{config('app.name')}} Team.</b>
	    </p> 
	  </div>
	  <h5 style="margin-top: 10px;" class="text-center">&copy; {{strtoupper(config('app.name'))}} {{date('Y')}}</h5>
	</div>

</body>
</html>