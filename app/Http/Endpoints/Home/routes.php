<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@getIndex']);

	Route::get('search', ['as' => 'home.search', 'uses' => 'SearchController@getSearch']);
	Route::post('search', ['as' => 'home.search', 'uses' => 'SearchController@postSearch']);

	Route::get('signup', ['as' => 'home.signup', 'uses' => 'UserController@getSignUp']);
	Route::post('signup', ['as' => 'home.signup', 'uses' => 'UserController@postSignUp']);

	Route::get('view-profile', ['as' => 'home.acouunt', 'uses' => 'UserController@getAccount']);
	Route::get('account', ['as' => 'home.acouunt', 'uses' => 'UserController@getAccount']);
	Route::post('account', ['as' => 'home.account', 'uses' => 'UserController@updateAccount']);
	
	Route::post('account/setting/password', ['as' => 'home.account.setting.password', 'uses' => 'UserController@updateSettingPassword']);
	Route::post('account/setting/contact', ['as' => 'home.account.setting.contact', 'uses' => 'UserController@updateSettingContact']);
	Route::post('account/setting/address', ['as' => 'home.account.setting.address', 'uses' => 'UserController@updateSettingAddress']);

	Route::get('checkout', ['as' => 'home.checkout', 'uses' => 'CheckoutController@index']);
	Route::post('checkout', ['as' => 'home.checkout', 'uses' => 'CheckoutController@postCheckout']);

	Route::get('search/autocomplete', 'SearchController@autocomplete');
	Route::post('/check-update-booking', 'UserController@checkActionUpdateBooking');
	Route::get('/cancel-booking', 'UserController@cancelBooking');
	Route::get('/paypal', ['as'=>'home','uses'=>'HomeController@paypal']);
	Route::post('order-post', ['as'=>'order-post','uses'=>'HomeController@orderPost']);
});
