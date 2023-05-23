<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Rate Your Order - [#ZS{{$order->id}}] | {{config('app.name')}}</title>
</head>
<body>
	<div class="card" style="background-color: lightgrey;">
		<span class="text-center">
			<img src="{{config('app.url')}}/img/logo.png" style="width: 100px;">
		</span>
	  <div class="container card-body" style="background-color: white; margin-top: 50px; ">
	    <h3>Dear {{$order->user_name}},</h3>
		<p>
			Thank you for choosing {{config('app.name')}}. We hope you had a great experience with your recent order. We value your feedback and would appreciate it if you could take a moment to rate your overall experience.
		</p>
		<p>
			Order Number: #ZS{{$order->id}} <br>
			Order Date: {{$order->created_at}}
		</p>
		<p>
			Please rate your experience on a scale of 1 to 5, with 5 being the highest:<br>

			1. Product Quality: <br>
			2. Delivery Speed: <br>
			3. Customer Service:<br>
			4. Website/User Experience:<br><br>

			We would also love to hear any specific comments or suggestions you have regarding your order. Your feedback will help us improve our products and services to serve you better in the future.<br>

			Please click on the link below to rate your order:<br>
			<a href="{{route('rating.create', $token)}}">Click here to rate this product.</a>

			Your opinion matters to us, and we truly appreciate your time and input. Thank you for being a valued customer.<br>

			If you have any additional questions or concerns, please don't hesitate to reach out to our customer support team at [Customer Support Contact Information]. We are always here to assist you.<br>

			Thank you again for choosing {{config('app.name')}}. We look forward to serving you again in the future.
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