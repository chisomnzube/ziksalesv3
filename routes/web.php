<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingpageController;

use App\Http\Controllers\RatingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingpageController::class, 'index'])->name('landingpage');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

//route for rating
Route::prefix('rating')->group(function(){ 

    Route::get('/{token}', [RatingController::class, 'create'])->name('rating.create');

    Route::post('/store', [RatingController::class, 'store'])->name('rating.store');

});