<?php
use App\Http\Controllers\Detail_orderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderstController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register', 'UserController@register');
Route::post('/login', 'UserController@login');

//Route::middleware(['jwt.verify'])->group(function () {
   // Route::group(['middleware' => ['api.superadmin']], function()
   // {
        Route::delete('/customers/{id_customer}', 'CustomersController@destroy');
        Route::delete('/product/{id_product}', 'ProductController@destroy');
        Route::delete('/orders/{id}', 'OrdersController@destroy');
   // });
   // Route::group(['middleware' => ['api.admin']], function()
   // {
        Route::post('/customers', 'CustomersController@store');
        Route::put('/customers/{id_customer}', 'CustomersController@update');

        Route::post('/product', 'ProductController@store');
        Route::put('/product/{id_product}', 'ProductController@update');
        Route::post('/storecartdb','OrdersController@store');

       // Route::post('/orders', 'OrdersController@store');
        Route::put('/orders/{id}', 'OrdersController@update');


  //  });


//customers
Route::get('customers', 'CustomersController@show');
Route::get('/customers/{id_customer}', 'CustomersController@detail');


//product
Route::get('/product', 'ProductController@show');
Route::get('/product/{id_product}', 'ProductController@detail');


//orders
Route::get('/orders', 'OrdersController@show');
Route::get('/orders/{id}', 'OrdersController@detail');



//details
Route::get('/detail_order', 'Detail_ordersController@show');
Route::post('/detail_order', 'Detail_ordersController@store');
Route::get('/detail_order/{id}', 'Detail_ordersController@detail');
Route::put('/detail_order/{id}', 'Detail_ordersController@update');
Route::delete('/detail_order/{id}', 'Detail_ordersController@destroy');
//}
//);
