<?php

Route::group(['middleware' => ['web']], function () {

	Route::get('/', ['as' => 'home.index', 'uses' => 'HomeController@getIndex']);

});
