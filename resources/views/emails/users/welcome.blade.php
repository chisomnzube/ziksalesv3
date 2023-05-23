<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<title>Welcome to {{config('app.name')}}</title>
</head>
<body>
	<div class="card" style="background-color: lightgrey;">
		<span class="text-center">
			<img src="{{config('app.url')}}/img/logo.png" style="width: 100px;">
		</span>
	  <div class="container card-body" style="background-color: white; margin-top: 50px; ">
	    <h3>Hello, {{$user->name}}</h3>
		<p class="lead">Thank you for choosing <a href="{{config('app.url')}}">Ziksales</a> . We are delighted to have you as one of our highly esteemed customer! </p>
		<p>With us you will benefit from:</p>
		<ol>
		    <li>The best prices in Nigeria.</li>
		    <li>The most convenient shopping experience.</li>
		    <li>The largest selection of genuine product.</li>
		    <li>The best customer service in Nigeria.</li>
		    <li>The best platform to multiply your income.</li>
		    <li>The best platform to boost your brand.</li>
		</ol>
		<p>We welcome you to a life of easy buying and selling of goods and services anywhere, anytime! Sit back and enjoy our services as we strive to turn your everyday buying and selling experience into an extraordinary and less stressful one.</p>

						
	    <p>
	    	<b>Best Regards!!</b> <br> 
	    	<b>{{config('app.name')}} Team.</b>
	    </p> 
	  </div>
	  <h5 style="margin-top: 10px;" class="text-center">&copy; {{strtoupper(config('app.name'))}} {{date('Y')}}</h5>
	</div>

</body>
</html>