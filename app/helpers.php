<?php

use App\Models\Product;

function getProduct($id){
	$product = Product::find($id);

	return $product;
}