<?php

Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web', 'auth']], function () {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'DashboardController@getIndex']);

    Route::controller('users', UserController::class, [
		'getList'        => 'users.list',
		'getDatatables'  => 'users.datatables',
		'getDelete'      => 'users.delete',
		'postDeleteMany' => 'users.delete.many',
		'getCreate'      => 'users.create'
    ]);

});