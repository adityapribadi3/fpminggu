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

  Route::get('viewua', 'UserController@getUserAccount');
  Route::post('insertua', 'UserController@insertUserAccount');
  Route::delete('deleteua', 'UserController@deleteUserAccount');
  Route::put('updateua', 'UserController@updateUserAccount');
  Route::get('validateAddress','UserController@checkAddress');

  Route::get('product/{id}','ProductController@getProductById');

  Route::get('viewupm', 'UserPaymentMethodController@getUserPaymentMethod');
  Route::post('insertupm', 'UserPaymentMethodController@insertUserPaymentMethod');
  Route::delete('deleteupm', 'UserPaymentMethodController@deleteUserPaymentMethod');
  Route::put('updateupm', 'UserPaymentMethodController@updateUserPaymentMethod');

  Route::get('viewpm', 'PaymentMethodController@getPaymentMethod');
  Route::post('insertpm', 'PaymentMethodController@insertPaymentMethod');
  Route::delete('deletepm', 'PaymentMethodController@deletePaymentMethod');
  Route::put('updatepm', 'PaymentMethodController@updatePaymentMethod');

  Route::get('viewuadd', 'UserAddressController@getUserAddress');
  Route::post('insertuadd', 'UserAddressController@insertUserAddress');
  Route::delete('deleteuadd/{id}', 'UserAddressController@deleteUserAddress');
  Route::put('updateuadd', 'UserAddressController@updateUserAddress');

  Route::get('viewc', 'CartController@getCart');
  Route::get('validateCart','CartController@checkCart');
  Route::post('insertc', 'CartController@insertCart');
  Route::delete('deletec', 'CartController@deleteCart');
  Route::put('update_cart_qty', 'CartController@updateCartQty');
  Route::delete('delete_item_cart/{id}', 'CartController@deleteItemFromCart');

  Route::get('view_request_order', 'OrderController@getReqOrder');
  Route::get('view_order_details/{id}','OrderController@getOrderDetails');
  Route::get('view_order', 'OrderController@getOrder');
  Route::post('inserto', 'OrderController@insertOrder');
  Route::delete('delete_order/{id}', 'OrderController@deleteOrder');
  Route::put('updateo', 'OrderController@updateOrder');
  Route::get('shipment_address/{id}', 'OrderController@getOrderShipmentAddress');

  Route::get('views', 'ShipmentController@getShipment');
  Route::post('inserts', 'ShipmentController@insertShipment');
  Route::delete('deletes', 'ShipmentController@deleteShipment');
  Route::put('updates', 'ShipmentController@updateShipment');

  Route::get('viewoi', 'OrderItemController@getOrderItem');
  Route::post('insertoi', 'OrderItemController@insertOrderItem');
  Route::delete('deleteoi', 'OrderItemController@deleteOrderItem');
  Route::put('updateoi', 'OrderItemController@updateOrderItem');

  Route::get('veritrans_url/{order_id}', 'VeritransController@vtweb');
  Route::post('vt_notif', 'VeritransController@notification');

});


Route::get('viewp/{name}', 'ProductController@getProduct');
Route::post('insertp', 'ProductController@insertProduct');
Route::delete('deletep', 'ProductController@deleteProduct');
Route::put('updatep', 'ProductController@updateProduct');


Route::get('viewpd', 'ProductDetailController@getProductDetail');
Route::post('insertpd', 'ProductDetailController@insertProductDetail');
Route::delete('deletepd', 'ProductDetailController@deleteProductDetail');
Route::put('updatepd', 'ProductDetailController@updateProductDetail');

Route::get('viewcat', 'CategoryController@getCategory');
Route::post('insertcat', 'CategoryController@insertCategory');
Route::delete('deletecat', 'CategoryController@deleteCategory');
Route::put('updatecat', 'CategoryController@updateCategory');

Route::get('viewcd', 'CategoryDetailController@getCategoryDetail');
Route::post('insertcd', 'CategoryDetailController@insertCategoryDetail');
Route::delete('deletecd', 'CategoryDetailController@deleteCategoryDetail');
Route::put('updatecd', 'CategoryDetailController@updateCategoryDetail');
