<?php
Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web','admin']], function () {

    Route::get('/', ['middleware' => ['role'], 'as' => 'admin.index', 'uses' => 'DashBoardController@getIndex']);
    Route::get('/home', array('middleware' => array('role'), 'as' => 'admin.home', 'uses' => 'DashBoardController@getIndex'));
    Route::get('/data/address', ['middleware' => ['role'], 'uses' => 'DashBoardController@getDataAddress']);

    /* one page*/
    Route::get('/search-tag', array('as' => 'admin.search-tag', 'uses' => 'DashBoardController@getSearchTag'));

    # Error pages should be shown without requiring login
    Route::get('404', function () {
        return View('admin/404');
    });
    Route::get('500', function () {
        return View::make('admin/500');
    });

    # Lock screen
    Route::get('lockscreen', function () {
        return View::make('admin/lockscreen');
    });
    
    # User Management
    Route::group(array('prefix' => 'users','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.users', 'uses' => 'UsersController@index'));
        Route::get('/data-list', array('as' => 'admin.users.data-list', 'uses' => 'UsersController@getDataList'));
        Route::get('create', array('as' => 'admin.users.create', 'uses' => 'UsersController@create'));
        Route::post('create', array('as' => 'admin.users.create', 'uses' => 'UsersController@store','role' => 'create'));
        Route::get('edit-{userId}', array('as' => 'admin.users.edit', 'uses' => 'UsersController@edit', 'role' => 'edit'));
        Route::put('edit-{userId}', array('as' => 'admin.users.edit', 'uses' => 'UsersController@update', 'role' => 'edit'));
        Route::get('delete-{userId}', array('as' => 'admin.users.delete', 'uses' => 'UsersController@destroy', 'role' => 'delete'));
        //Route::get('{userId}', array('as' => 'users.show', 'uses' => 'UsersController@show'));
        Route::post('passwordreset', 'UsersController@passwordreset');
    });
    //Route::resource('users', 'UsersController');

    # UserGroup Management
    Route::group(array('prefix' => 'usergroup','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.usergroup', 'uses' => 'UserGroupController@index', 'role' => 'view_all'));
        Route::get('create', array('as' => 'admin.usergroup.create', 'uses' => 'UserGroupController@create'));
        Route::post('create', array('as' => 'admin.usergroup.store', 'uses' => 'UserGroupController@store', 'role' => 'create'));
        Route::get('edit-{usergroupId}', array('as' => 'admin.usergroup.edit', 'uses' => 'UserGroupController@edit'));
        Route::post('edit-{usergroupId}', array('as' => 'admin.usergroup.update', 'uses' => 'UserGroupController@update', 'role' => 'edit'));
        Route::get('delete-{usergroupId}', array('as' => 'admin.usergroup.delete', 'uses' => 'UserGroupController@destroy', 'role' => 'delete'));
        Route::get('confirm-delete-{usergroupId}', array('as' => 'admin.usergroup.confirm-delete', 'uses' => 'UserGroupController@getModalDelete', 'role' => 'delete'));
    });
    
	# Customer Management
    Route::group(array('prefix' => 'customergroup','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.customergroup', 'uses' => 'UserGroupController@index', 'alias_controller' => 'customergroup', 'role' => 'view_all'));
        Route::get('create', array('as' => 'admin.customergroup.create', 'uses' => 'UserGroupController@create', 'alias_controller' => 'customergroup'));
        Route::post('create', array('as' => 'admin.customergroup.store', 'uses' => 'UserGroupController@store', 'role' => 'create', 'alias_controller' => 'customergroup'));
        Route::get('edit-{usergroupId}', array('as' => 'admin.customergroup.edit', 'uses' => 'UserGroupController@edit', 'alias_controller' => 'customergroup'));
        Route::post('edit-{usergroupId}', array('as' => 'admin.customergroup.update', 'uses' => 'UserGroupController@update', 'role' => 'edit', 'alias_controller' => 'customergroup'));
        Route::get('delete-{usergroupId}', array('as' => 'admin.customergroup.delete', 'uses' => 'UserGroupController@destroy', 'role' => 'delete', 'alias_controller' => 'customergroup'));
        Route::get('confirm-delete-{usergroupId}', array('as' => 'admin.customergroup.confirm-delete', 'uses' => 'UserGroupController@getModalDelete', 'role' => 'delete', 'alias_controller' => 'customergroup'));
    });
	
    # Media Management
    Route::group(array('prefix' => 'media','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.media', 'uses' => 'MediaController@index', 'role' => 'view_all'));
        Route::get('upload', array('as' => 'admin.media.upload', 'uses' => 'MediaController@upload'));
        Route::post('upload', array('as' => 'admin.media.upload_save', 'uses' => 'MediaController@store', 'role' => 'upload'));
        Route::post('gallery', array('as' => 'admin.media.gallery', 'uses' => 'MediaController@gallery', 'role' => 'view_all'));
        Route::get('edit-{fileId}', array('as' => 'admin.media.edit', 'uses' => 'MediaController@edit'));
        Route::post('edit-{fileId}', array('as' => 'admin.media.update', 'uses' => 'MediaController@update', 'role' => 'edit'));
        Route::get('delete-{fileId}', array('as' => 'admin.media.delete', 'uses' => 'MediaController@destroy', 'role' => 'delete'));
    });

    # Category Management
    Route::group(array('prefix' => 'category','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.category', 'uses' => 'CategoryController@index'));
        Route::get('/data-list', array('as' => 'admin.category.data-list', 'uses' => 'CategoryController@getDataList'));
        Route::get('create', array('as' => 'admin.category.create', 'uses' => 'CategoryController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.category.create', 'uses' => 'CategoryController@store','role' => 'create'));
        Route::get('edit-{categoryId}', array('as' => 'admin.category.edit', 'uses' => 'CategoryController@edit', 'role' => 'edit'));
        Route::post('edit-{categoryId}', array('as' => 'admin.category.edit', 'uses' => 'CategoryController@update', 'role' => 'edit'));
        Route::get('delete-{categoryId}', array('as' => 'admin.category.delete', 'uses' => 'CategoryController@destroy', 'role' => 'delete'));
        //Route::get('{categoryId}/restore', array('as' => 'admin.category.restore', 'uses' => 'CategoryController@getRestore', 'role' => 'restore'));
        //Route::get('{categoryId}', array('as' => 'admin.category.show', 'uses' => 'CategoryController@show'));
    });

    //Route::controller('category', 'CategoryController');
    # Product Category Management
    Route::group(array('prefix' => 'product_cat','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.product_cat', 'uses' => 'CategoryController@index'));
        Route::get('/data-list', array('as' => 'admin.product_cat.data-list', 'uses' => 'CategoryController@getDataList'));
        Route::get('create', array('as' => 'admin.product_cat.create', 'uses' => 'CategoryController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.product_cat.create', 'uses' => 'CategoryController@store','role' => 'create'));
        Route::get('edit-{categoryId}', array('as' => 'admin.product_cat.edit', 'uses' => 'CategoryController@edit', 'role' => 'edit'));
        Route::post('edit-{categoryId}', array('as' => 'admin.product_cat.edit', 'uses' => 'CategoryController@update', 'role' => 'edit'));
        Route::get('delete-{categoryId}', array('as' => 'admin.product_cat.delete', 'uses' => 'CategoryController@destroy', 'role' => 'delete'));
        //Route::get('{categoryId}/restore', array('as' => 'admin.category.restore', 'uses' => 'CategoryController@getRestore', 'role' => 'restore'));
        //Route::get('{categoryId}', array('as' => 'admin.category.show', 'uses' => 'CategoryController@show'));
    });

    # Product Category Management
    Route::group(array('prefix' => 'product_color','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.product_color', 'uses' => 'CategoryController@index'));
        Route::get('/data-list', array('as' => 'admin.product_color.data-list', 'uses' => 'CategoryController@getDataList'));
        Route::get('create', array('as' => 'admin.product_color.create', 'uses' => 'CategoryController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.product_color.create', 'uses' => 'CategoryController@store','role' => 'create'));
        Route::get('edit-{categoryId}', array('as' => 'admin.product_color.edit', 'uses' => 'CategoryController@edit', 'role' => 'edit'));
        Route::post('edit-{categoryId}', array('as' => 'admin.product_color.edit', 'uses' => 'CategoryController@update', 'role' => 'edit'));
        Route::get('delete-{categoryId}', array('as' => 'admin.product_color.delete', 'uses' => 'CategoryController@destroy', 'role' => 'delete'));
    });

    # Product Category Management
    Route::group(array('prefix' => 'product_label','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.product_label', 'uses' => 'CategoryController@index'));
        Route::get('/data-list', array('as' => 'admin.product_label.data-list', 'uses' => 'CategoryController@getDataList'));
        Route::get('create', array('as' => 'admin.product_label.create', 'uses' => 'CategoryController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.product_label.create', 'uses' => 'CategoryController@store','role' => 'create'));
        Route::get('edit-{categoryId}', array('as' => 'admin.product_label.edit', 'uses' => 'CategoryController@edit', 'role' => 'edit'));
        Route::post('edit-{categoryId}', array('as' => 'admin.product_label.edit', 'uses' => 'CategoryController@update', 'role' => 'edit'));
        Route::get('delete-{categoryId}', array('as' => 'admin.product_label.delete', 'uses' => 'CategoryController@destroy', 'role' => 'delete'));
    });
    
    # Product Management
    Route::group(array('prefix' => 'product','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.product', 'uses' => 'ProductController@index'));
        Route::get('/data-list', array('as' => 'admin.product.data-list', 'uses' => 'ProductController@getDataList'));
        Route::get('create', array('as' => 'admin.product.create', 'uses' => 'ProductController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.product.create', 'uses' => 'ProductController@store','role' => 'create'));
        Route::get('edit-{productId}', array('as' => 'admin.product.edit', 'uses' => 'ProductController@edit', 'role' => 'edit'));
        Route::post('edit-{productId}', array('as' => 'admin.product.edit', 'uses' => 'ProductController@update', 'role' => 'edit'));
        Route::get('delete-{productId}', array('as' => 'admin.product.delete', 'uses' => 'ProductController@destroy', 'role' => 'delete'));
    });
    //Route::controller('product', 'ProductController');

    # Coupon Management
    Route::group(array('prefix' => 'coupon','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.coupon', 'uses' => 'CouponController@index'));
        Route::get('/data-list', array('as' => 'admin.coupon.data-list', 'uses' => 'CouponController@getDataList'));
        Route::get('create', array('as' => 'admin.coupon.create', 'uses' => 'CouponController@create','role' => 'create'));
        Route::post('create', array('as' => 'admin.coupon.create', 'uses' => 'CouponController@store','role' => 'create'));
        Route::get('edit-{id}', array('as' => 'admin.coupon.edit', 'uses' => 'CouponController@edit', 'role' => 'edit'));
        Route::post('edit-{id}', array('as' => 'admin.coupon.edit', 'uses' => 'CouponController@update', 'role' => 'edit'));
        Route::get('delete-{id}', array('as' => 'admin.coupon.delete', 'uses' => 'CouponController@destroy', 'role' => 'delete'));
    });

    # Order Management
    Route::group(array('prefix' => 'order','middleware' => array('role')), function () {
        Route::get('/', array('as' => 'admin.order', 'uses' => 'OrderController@index'));
        Route::get('/data-list', array('as' => 'admin.order.data-list', 'uses' => 'OrderController@getDataList'));
        Route::get('delete-{id}', array('as' => 'admin.order.delete', 'uses' => 'OrderController@destroy', 'role' => 'delete'));
        Route::get('{item}', array('as' => 'admin.order.show', 'uses' => 'OrderController@show'));
    });

    # Post Management
    Route::group(array('prefix' => 'config'), function () {
        Route::controller('/', 'ConfigController');
    });

});
