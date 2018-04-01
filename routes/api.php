<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['jwt.auth']], function() {
  Route::get('logout', 'AuthController@logout');
  Route::get('me', 'AuthController@me');

  // Route::get('viewua', 'UserController@getUserAccount');
  // Route::post('insertua', 'UserController@insertUserAccount');
  // Route::delete('deleteua', 'UserController@deleteUserAccount');
  Route::put('user', 'UserController@updateUserAccount');
  Route::get('validateAddress','UserController@checkAddress');

  Route::get('complete_order','OrderController@getCompleteOrder');

  // Route::get('viewupm', 'UserPaymentMethodController@getUserPaymentMethod');
  // Route::post('insertupm', 'UserPaymentMethodController@insertUserPaymentMethod');
  // Route::delete('deleteupm', 'UserPaymentMethodController@deleteUserPaymentMethod');
  // Route::put('updateupm', 'UserPaymentMethodController@updateUserPaymentMethod');

  // Route::get('viewpm', 'PaymentMethodController@getPaymentMethod');
  // Route::post('insertpm', 'PaymentMethodController@insertPaymentMethod');
  // Route::delete('deletepm', 'PaymentMethodController@deletePaymentMethod');
  // Route::put('updatepm', 'PaymentMethodController@updatePaymentMethod');

  Route::get('address', 'UserAddressController@getUserAddress');
  Route::post('address', 'UserAddressController@insertUserAddress');
  Route::delete('address/{id}', 'UserAddressController@deleteUserAddress');
  Route::put('address', 'UserAddressController@updateUserAddress');

  Route::get('cart', 'CartController@getCart');
  Route::get('validateCart','CartController@checkCart');
  Route::post('cart', 'CartController@insertCart');
  Route::delete('cart', 'CartController@deleteCart');
  Route::put('cart', 'CartController@updateCartQty');
  Route::delete('cart/{id}', 'CartController@deleteItemFromCart');

  Route::get('request_order', 'OrderController@getReqOrder');
  Route::get('orderitem/{id}','OrderController@getOrderDetails');
  Route::get('order', 'OrderController@getOrder');
  Route::post('order', 'OrderController@insertOrder');
  Route::delete('order/{id}', 'OrderController@deleteOrder');
  Route::put('updateo', 'OrderController@updateOrder');
  Route::get('shipment_address/{id}', 'OrderController@getOrderShipmentAddress');

  Route::get('order_items/{id}', 'OrderItemController@getOrderItem');
  // Route::post('orderitem', 'OrderItemController@insertOrderItem');
  // Route::delete('orderitem', 'OrderItemController@deleteOrderItem');
  // Route::put('orderitem', 'OrderItemController@updateOrderItem');
  Route::get('validateQty/{order_id}','ProductController@validateQty');

  Route::get('veritrans_url/{order_id}', 'VeritransController@vtweb');
});
Route::get('product/{id}','ProductController@getProductById');
Route::post('vt_notif','VeritransController@notification');
Route::get('topproduct','ProductController@getTopProduct');

Route::get('category/{name}', 'ProductController@getProduct');
// Route::post('product', 'ProductController@insertProduct');
// Route::delete('deletep', 'ProductController@deleteProduct');
// Route::put('updatep', 'ProductController@updateProduct');


Route::get('productdetail', 'ProductDetailController@getProductDetail');
// Route::post('productdetail', 'ProductDetailController@insertProductDetail');
// Route::delete('productdetail', 'ProductDetailController@deleteProductDetail');
// Route::put('productdetail', 'ProductDetailController@updateProductDetail');


Route::get('category', 'CategoryController@getCategory');
// Route::post('insertcat', 'CategoryController@insertCategory');
// Route::delete('deletecat', 'CategoryController@deleteCategory');
// Route::put('updatecat', 'CategoryController@updateCategory');

// Route::get('viewcd', 'CategoryDetailController@getCategoryDetail');
// Route::post('insertcd', 'CategoryDetailController@insertCategoryDetail');
// Route::delete('deletecd', 'CategoryDetailController@deleteCategoryDetail');
// Route::put('updatecd', 'CategoryDetailController@updateCategoryDetail');

Route::get('search','Search@search');
