<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@getIndex']);

	Route::get('signup', ['as' => 'home.signup', 'uses' => 'HomeController@showSignUp']);
	Route::post('signup', ['as' => 'home.signup', 'uses' => 'HomeController@postSignUp']);

	Route::get('account', ['as' => 'home.acouunt', 'uses' => 'HomeController@showAccount']);
	Route::post('account', ['as' => 'home.account', 'uses' => 'HomeController@updateAccount']);

	Route::get('checkout', ['as' => 'home.checkout', 'uses' => 'HomeController@showCheckout']);
	Route::post('checkout', ['as' => 'home.checkout', 'uses' => 'HomeController@postCheckout']);
});
