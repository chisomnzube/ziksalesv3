<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	  <link rel="stylesheet" type="text/css" href="{{ asset('css/starability-minified/starability-all.min.css') }}"/>
	<title>Rate Your Order - [#ZS{{$order->id}}] | {{config('app.name')}}</title>
</head>
<body>
	<div class="card" style="background-color: lightgrey;">
		<span class="text-center">
			<img src="{{config('app.url')}}/img/logo.png" style="width: 100px;">
		</span>
	  <div class="container card-body" style="background-color: white; margin-top: 50px; ">
	    <h4>We would love your ratings and review for #ZS{{$order->id}}</h4>

          <div class="text-center py-5 my-5">
            <div class="row">
              <div class="col-md-8">
                <form action="{{ route('rating.store') }}" method="POST" class="form-group">
                  @csrf
                  @captcha

                  <fieldset class="starability-basic">
                    <legend>Your rating:</legend>
                    <input type="radio" id="no-rate" class="input-no-rate" name="rating" value="0" checked aria-label="No rating." />

                    <input type="radio" id="rate1" name="rating" value="1" />
                    <label for="rate1">1 star.</label>

                    <input type="radio" id="rate2" name="rating" value="2" />
                    <label for="rate2">2 stars.</label>

                    <input type="radio" id="rate3" name="rating" value="3" />
                    <label for="rate3">3 stars.</label>

                    <input type="radio" id="rate4" name="rating" value="4" />
                    <label for="rate4">4 stars.</label>

                    <input type="radio" id="rate5" name="rating" value="5" />
                    <label for="rate5">5 stars.</label>

                    <span class="starability-focus-ring"></span>
                  </fieldset><br>

                  <textarea class="form-control" name="review" placeholder="Review..."></textarea><br>
                  <input type="hidden" name="Thetoken" value="{{$rating->token}}">
                  <button class="btn btn-info" type="submit">Submit</button>

              </form>
              </div>
            </div>
            
          </div>
	</div>

</body>
</html>