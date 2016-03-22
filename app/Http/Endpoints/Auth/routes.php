<?php

Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web']], function () {

    // Authentication Routes...
    $this->get('login', ['as' => 'auth.login', 'uses' => 'AuthController@showLoginForm']);
    $this->post('login', ['as' => 'auth.login', 'uses' => 'AuthController@login']);
    $this->get('logout', ['as' => 'auth.logout', 'uses' => 'AuthController@logout']);

    // Password Reset Routes...
    $this->get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'PasswordController@showResetForm']);
    $this->post('password/email', ['as' => 'auth.password.email', 'uses' => 'PasswordController@sendResetLinkEmail']);
    $this->post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'PasswordController@reset']);

});
