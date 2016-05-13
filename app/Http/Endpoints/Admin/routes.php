<?php

Route::group(['prefix' => config('app.admin_dir'), 'middleware' => ['web', 'auth']], function () {

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

    Route::controller('teacher', TeacherController::class, [
        'getListForBooking' => 'teacher.list',
        'getDelete' => 'teacher.delete',
        'postCreate' => 'teacher.create.post',
        'postEdit' => 'teacher.edit.post',
        'getTeachers' => 'teacher.listdata',
        'postUpdateTeacher' => 'teacher.update',
    ]);
    
    Route::controller('clubs', ClubController::class, [
        'getSetting' => 'clubs.setting',
        'getManagerBookings' => 'clubs.manager-bookings',
        'getCourts' => 'clubs.courts.list',
        'postSetOpenDay' => 'clubs.courts.setOpenDay',
        'getListDays' => 'clubs.courts.listdays',
        'postSetEventDay' => 'clubs.courts.setEventDay',
        'getStates' => 'clubs.states',
        'getCitys' =>'clubs.citys'
    ]);
    Route::controller('courts', CourtController::class, [
        'postCreateCourt' => 'courts.create',
        'postUpdateCourt' => 'courts.update',
        'postUpdateCourts' => 'courts.update.multi',
        'getList' => 'courts.list',
    ]);
    Route::controller('contracts', ContractController::class, [
        'postCreateContract' => 'contracts.create',
        'postUpdateContract' => 'contracts.update',
        'deleteContract' => 'contracts.delete',
        'getListContract' => 'contracts.list',
        'getList' => 'contracts.listContract',
        'getView' => 'contracts.getView'
    ]);
    Route::controller('surface', SurfaceController::class, [
        'getList' => 'surface.list',
    ]);
    Route::controller('dashboard', DashboardController::class, [
        'getAddContext' => 'dashboard.context',
        'getClubs' => 'dashboard.clubs.list',
    ]);
    Route::controller('booking', ManageBookingController::class, [
        'getManageBooking' => 'booking.index',
        'getDataOfClub' => 'booking.dataOfClub',
        'postViewPriceOrder' =>'booking.viewPriceOrder',
        'postCheckCourtBooking' =>'booking.postCheckCourtBooking',
        'postCheckInputCustomer' =>'booking.checkInputCustomer',
        'postPayment' =>'booking.postPayment',
        'postCheckPlayerforBooking' =>'booking.checkPlayerforBooking',
        'getView' =>'booking.view',
        'getCancel' =>'booking.cancel',
        'getAcceptPayment' =>'booking.acceptPayment',
        'getSearchPlayers' =>'booking.players',
        'getInfoGridAvailable' =>'booking.infoGridAvailable',
        'postMakeTimeUnavailable' =>'booking.makeTimeUnavailable',
        'getInfoGridForDeal' => 'booking.getInfoGridForDeal',
        'postNewDeal' => 'booking.newDeal',
        'getSearch' => 'booking.search'
    ]);

    Route::controller('reports', ReportController::class, [
        'getIndex' => 'reports.index',
        'getData' => 'reports.listdata'
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