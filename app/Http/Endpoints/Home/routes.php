<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@getIndex']);
	Route::get('/error', ['as' => 'home.error', 'uses' => 'HomeController@getError']);

	Route::get('search', ['as' => 'home.search', 'uses' => 'HomeController@getIndex']);
	Route::post('search', ['as' => 'home.search', 'uses' => 'SearchController@search']);

	Route::get('/deals', ['as' => 'home.deals', 'uses' => 'HomeController@getDeals']);

	Route::get('signup', ['as' => 'home.signup', 'uses' => 'PlayerController@getSignUp']);
	Route::post('signup', ['as' => 'home.signup', 'uses' => 'PlayerController@postSignUp']);

	Route::get('view-profile', ['as' => 'home.acount', 'uses' => 'PlayerController@getAccount']);
	Route::get('account', ['as' => 'home.acouunt', 'uses' => 'PlayerController@getAccount']);
	Route::post('account', ['as' => 'home.account', 'uses' => 'PlayerController@updateAccount']);
	
	Route::post('account/setting/password', ['as' => 'home.account.setting.password', 'uses' => 'PlayerController@updateSettingPassword']);
	Route::post('account/setting/contact', ['as' => 'home.account.setting.contact', 'uses' => 'PlayerController@updateSettingContact']);
	Route::post('account/setting/address', ['as' => 'home.account.setting.address', 'uses' => 'PlayerController@updateSettingAddress']);

	Route::get('checkout', ['as' => 'home.checkout', 'uses' => 'BookingController@index']);
	Route::post('checkout', ['as' => 'home.checkout', 'uses' => 'BookingController@postCheckout']);
	Route::post('print-confirmation', ['as' => 'home.print_confirmation', 'uses' => 'BookingController@printConfirmation']);
	Route::post('send-mail', ['as' => 'home.send_mail', 'uses' => 'BookingController@sendMailOrder']);
	Route::get('search/autocomplete', 'SearchController@autocomplete');

	Route::post('/check-update-booking', 'BookingController@checkActionUpdateBooking');
	Route::post('/cancel-booking', 'BookingController@cancelBooking');

	Route::get('price', ['as' => 'home.send_mail', 'uses' => 'SearchController@checkPrice']);
});
