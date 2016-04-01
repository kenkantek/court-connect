<?php

Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web', 'auth','admin']], function () {

    Route::get('/', ['as' => 'admin.index', 'uses' => 'DashboardController@getIndex']);

    Route::controller('users', UserController::class, [
        'getList' => 'users.list',
        'getDatatables' => 'users.datatables',
        'getDelete' => 'users.delete',
        'postCreate' => 'users.create.post',
        'postEdit' => 'users.edit.post',
        'getUsers' => 'users.listdata',
        'postUpdateUser' => 'users.update',
    ]);

    Route::controller('clubs', ClubController::class, [
        'getSetting' => 'clubs.setting',
        'getManagerBookings' => 'clubs.manager-bookings',
        'getCourts' => 'clubs.courts.list',
        'postSetOpenDay' => 'clubs.courts.setOpenDay',
        'getListDays' => 'clubs.courts.listdays',
        'getSetEventDay' => 'clubs.courts.setEventDay',
    ]);
    Route::controller('courts', CourtController::class, [
        'postCreateCourt' => 'courts.create',
        'postUpdateCourt' => 'courts.update',
        'postUpdateCourts' => 'courts.update.multi',
    ]);
    Route::controller('surface', SurfaceController::class, [
        'getList' => 'surface.list',
    ]);
    Route::controller('dashboard', DashboardController::class, [
        'getAddContext' => 'dashboard.context',
        'getClubs' => 'dashboard.clubs.list',
    ]);

});

Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web', 'auth','admin','super']], function () {
    Route::controller('super', SuperAdminController::class, [
        'getIndex' => 'super.index',
        'getClubs' => 'super.clubs.list',
        'postCreateClub' => 'super.clubs.create',
        'deleteClub' => 'super.clubs.delete',
        'putEditClub' => 'super.clubs.edit',
    ]);
});