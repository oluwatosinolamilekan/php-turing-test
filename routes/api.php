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

Route::group(['prefix' => 'attributes'], function () {
    Route::get('/', 'AttributeController@getAllAttributes');
    Route::get('/{attribute_id}', 'AttributeController@getSingleAttribute');
    Route::get('/values/{attribute_id}', 'AttributeController@getAttributeValues');
    Route::get('/inProduct/{product_id}', 'AttributeController@getProductAttributes');
});

Route::post('/customers', 'CustomerController@updateCreditCard');
Route::post('/customers/login', 'CustomerController@login');
Route::get('/customer/{customer_id}', 'CustomerController@getCustomerProfile');
Route::put('/customer/{customer_id}', 'CustomerController@apply');
Route::put('/customer/address/{customer_id}', 'CustomerController@updateCustomerAddress');
Route::put('/customer/creditCard/{customer_id}', 'CustomerController@updateCreditCard');





Route::get('/products/search', 'ProductController@searchProduct');

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductController@getAllProducts');
    Route::get('/{product_id}', 'ProductController@getProduct');
    Route::get('/inCategory/{category_id}', 'ProductController@getProductsByCategory');
    Route::get('/inDepartment/{department_id}', 'ProductController@getProductsInDepartment');
    Route::get('/{product_id}/reviews', 'ProductController@getProductsReview');
    Route::post('/{product_id}/reviews', 'ProductController@postProductsReview');
});


Route::group(['prefix' => 'departments'], function () {
    Route::get('/', 'ProductController@getAllDepartments');
    Route::get('/{department_id}', 'ProductController@getDepartment');

});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'ProductController@getAllCategories');
    Route::get('/{category_id}', 'ProductController@toString');
    Route::get('/inDepartment/{category_id}', 'ProductController@getDepartmentCategories');
    Route::get('/inProduct/{product_id}', 'ProductController@getProductCategory');


});


Route::get('/shipping/regions', 'ShippingController@getShippingRegions');
Route::get('/shipping/regions/{shipping_region_id}', 'ShippingController@getShippingType');



Route::group(['prefix' => 'shoppingcart'], function () {
    Route::get('/generateUniqueId', 'ShoppingCartController@generateUniqueCart');
    Route::post('/add', 'ShoppingCartController@addItemToCart');
    Route::get('/{cart_id}', 'ShoppingCartController@getCart');
    Route::put('/update/{item_id}', 'ShoppingCartController@updateCartItem');
    Route::delete('/empty/{cart_id}', 'ShoppingCartController@emptyCart');
    Route::delete('/removeProduct/{item_id}', 'ShoppingCartController@removeItemFromCart');
});

Route::group(['prefix' => 'orders'], function () {
    Route::post('/', 'ShoppingCartController@createOrder');
    Route::get('/inCustomer', 'ShoppingCartController@getCustomerOrders');
    Route::get('/{order_id}', 'ShoppingCartController@getOrderSummary');
    Route::get('shortDetail/{order_id}', 'ShoppingCartController@shortDetail');
});

Route::post('/stripe/charge', 'ShoppingCartController@processStripePayment');


Route::get('/tax', 'TaxController@getAllTax');
Route::get('/tax/{tax_id}', 'TaxController@getTaxById');