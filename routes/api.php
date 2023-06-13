<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;

use App\Http\Controllers\Api\SectionsController;
use App\Http\Controllers\Api\ProductsController;

use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\OrdersController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



//route for auth
Route::prefix('auth')->group(function(){ 

    Route::post('/register', [AuthController::class, 'register']);

    Route::post('/login', [AuthController::class, 'login']);

});

//route for section
Route::prefix('section')->group(function(){ 

    Route::get('/', [SectionsController::class, 'index']);

    Route::get('/shops/{section_id}', [SectionsController::class, 'shops']);    

    Route::get('/banners', [SectionsController::class, 'banners']);

    Route::get('/flash-sales', [SectionsController::class, 'flashSales']);

    Route::get('/still-available', [SectionsController::class, 'stillAvailable']);

});

//route for product
Route::prefix('product')->group(function(){ 

    Route::get('/all', [ProductsController::class, 'all']);

    Route::get('/{id}', [ProductsController::class, 'single']);

    Route::get('/section/{section_id}', [ProductsController::class, 'sectionProducts']);

    Route::get('/shop/{shop_id}', [ProductsController::class, 'shopProducts']);

});


Route::middleware('jwt.auth')->group(function () {
    //route for payment
    Route::prefix('payment')->group(function(){ 

        Route::post('/', [PaymentsController::class, 'appPayment']);

    });

    //route for orders
    Route::prefix('orders')->group(function(){ 

        Route::get('/delivery-fee/{prods_id}', [OrdersController::class, 'getDeliveryFee']);

        Route::get('/', [OrdersController::class, 'getMyOrdersSummary']);

    });

    //route for auth
    Route::prefix('auth')->group(function(){ 

        Route::post('/update', [AuthController::class, 'update']);

        Route::get('/delete-user', [AuthController::class, 'deleteUser']);

    });
});

