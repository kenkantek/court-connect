<?php
Route::group(['middleware' => ['web']], function () {

    Route::get('auth/social/{driver}/callback', [
            'as'   => 'auth.social.callback',
            'uses' => 'AuthController@handleProviderCallback']
    );
    Route::get('auth/social/{driver}', [
            'as'   => 'auth.social',
            'uses' => 'AuthController@redirectToProvider']
    );


    Route::get('logout', [
        'as' => 'auth.logout-home',
        'uses' => 'AuthController@logout'
    ]);

    Route::post('login', [
        'as' => 'auth.login-home',
        'uses' => 'AuthController@ajaxlogin'
    ]);

    $this->get('password/reset', ['as' => 'auth.password.reset', 'uses' => 'PasswordController@forgetpassword']);
    $this->get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'PasswordController@userresetpassword']);
    $this->post('password/email', ['as' => 'auth.password.email', 'uses' => 'PasswordController@sendResetLinkEmail']);

    Route::get('verify', [
        'as' => 'verify',
        'uses' => 'AuthController@getVerify'
    ]);

});

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
