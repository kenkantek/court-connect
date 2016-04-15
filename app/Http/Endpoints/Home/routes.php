<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@getIndex']);

	Route::get('search', ['as' => 'home.search', 'uses' => 'SearchController@getSearch']);
	Route::post('search', ['as' => 'home.search', 'uses' => 'SearchController@postSearch']);

	Route::get('signup', ['as' => 'home.signup', 'uses' => 'HomeController@getSignUp']);
	Route::post('signup', ['as' => 'home.signup', 'uses' => 'HomeController@postSignUp']);

	Route::get('account/{id}', ['as' => 'home.acouunt', 'uses' => 'HomeController@getAccount']);
	Route::post('account/{id}', ['as' => 'home.account', 'uses' => 'HomeController@updateAccount']);
	
	Route::post('account/setting/password/{id}', ['as' => 'home.account.setting.password', 'uses' => 'HomeController@updateSettingPassword']);
	Route::post('account/setting/contact/{id}', ['as' => 'home.account.setting.contact', 'uses' => 'HomeController@updateSettingContact']);
	Route::post('account/setting/address/{id}', ['as' => 'home.account.setting.address', 'uses' => 'HomeController@updateSettingAddress']);

	Route::get('checkout', ['as' => 'home.checkout', 'uses' => 'HomeController@showCheckout']);
	Route::post('checkout', ['as' => 'home.checkout', 'uses' => 'HomeController@postCheckout']);

	Route::get('search/autocomplete', 'SearchController@autocomplete');
});
