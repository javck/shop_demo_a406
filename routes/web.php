<?php

use Illuminate\Support\Facades\Route;

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

Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/', 'SiteController@renderHomePage');
    Route::get('/addcart/{ids}','SiteController@addCart');
    Route::get('/items/{id}','SiteController@renderItemDetailPage');
});
Route::get('/showcart',App\Http\Livewire\Cart::class);



Route::view('/cart','cart');

Route::view('/checkout','checkout');
Route::view('/confirm','confirmation');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::middleware(['auth'])->group(function(){
//保護某些路由需要登入才能訪問
    Route::get('/vip',function(){
        return 'VIP Zone';
    });
});

