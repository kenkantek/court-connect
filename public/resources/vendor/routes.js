(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home.index","action":"App\Http\Controllers\Home\HomeController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"contact","name":"contact","action":"App\Http\Controllers\Home\HomeController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"error","name":"home.error","action":"App\Http\Controllers\Home\HomeController@getError"},{"host":null,"methods":["GET","HEAD"],"uri":"alert","name":"home.alert","action":"App\Http\Controllers\Home\HomeController@getAlert"},{"host":null,"methods":["GET","HEAD"],"uri":"search\/autocomplete","name":null,"action":"App\Http\Controllers\Home\SearchController@autocomplete"},{"host":null,"methods":["GET","HEAD"],"uri":"search","name":"home.search","action":"App\Http\Controllers\Home\SearchController@search"},{"host":null,"methods":["POST"],"uri":"search","name":"home.search","action":"App\Http\Controllers\Home\SearchController@search"},{"host":null,"methods":["GET","HEAD"],"uri":"check-price","name":"home.check-price","action":"App\Http\Controllers\Home\SearchController@checkPrice"},{"host":null,"methods":["GET","HEAD"],"uri":"deals","name":"home.deals","action":"App\Http\Controllers\Home\HomeController@getDeals"},{"host":null,"methods":["GET","HEAD"],"uri":"signup","name":"home.signup","action":"App\Http\Controllers\Home\PlayerController@getSignUp"},{"host":null,"methods":["POST"],"uri":"signup","name":"home.signup","action":"App\Http\Controllers\Home\PlayerController@postSignUp"},{"host":null,"methods":["GET","HEAD"],"uri":"view-profile","name":"home.acount","action":"App\Http\Controllers\Home\PlayerController@getAccount"},{"host":null,"methods":["GET","HEAD"],"uri":"account","name":"home.acouunt","action":"App\Http\Controllers\Home\PlayerController@getAccount"},{"host":null,"methods":["POST"],"uri":"account","name":"home.account","action":"App\Http\Controllers\Home\PlayerController@updateAccount"},{"host":null,"methods":["POST"],"uri":"account\/setting\/password","name":"home.account.setting.password","action":"App\Http\Controllers\Home\PlayerController@updateSettingPassword"},{"host":null,"methods":["POST"],"uri":"account\/setting\/contact","name":"home.account.setting.contact","action":"App\Http\Controllers\Home\PlayerController@updateSettingContact"},{"host":null,"methods":["POST"],"uri":"account\/setting\/address","name":"home.account.setting.address","action":"App\Http\Controllers\Home\PlayerController@updateSettingAddress"},{"host":null,"methods":["POST"],"uri":"account\/setting\/other","name":"home.account.setting.other","action":"App\Http\Controllers\Home\PlayerController@updateSettingOther"},{"host":null,"methods":["GET","HEAD"],"uri":"checkout","name":"home.checkout","action":"App\Http\Controllers\Home\BookingController@checkout"},{"host":null,"methods":["POST"],"uri":"checkout","name":"home.checkout","action":"App\Http\Controllers\Home\BookingController@postBooking"},{"host":null,"methods":["POST"],"uri":"print-confirmation","name":"home.print_confirmation","action":"App\Http\Controllers\Home\BookingController@printConfirmation"},{"host":null,"methods":["POST"],"uri":"send-mail","name":"home.send_mail","action":"App\Http\Controllers\Home\BookingController@sendMailOrder"},{"host":null,"methods":["POST"],"uri":"check-update-booking","name":null,"action":"App\Http\Controllers\Home\BookingController@checkActionUpdateBooking"},{"host":null,"methods":["POST"],"uri":"cancel-booking","name":null,"action":"App\Http\Controllers\Home\BookingController@cancelBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"price","name":"home.send_mail","action":"App\Http\Controllers\Home\SearchController@checkPrice"},{"host":null,"methods":["GET","HEAD"],"uri":"export-calendar\/{id}\/{type}","name":"home.export-calendar","action":"App\Http\Controllers\Home\BookingController@getExportCalendar"},{"host":null,"methods":["GET","HEAD"],"uri":"page\/{slug}","name":null,"action":"App\Http\Controllers\Home\PageController@getViewPage"},{"host":null,"methods":["GET","HEAD"],"uri":"contact-us","name":"home.contact-us","action":"App\Http\Controllers\Home\PageController@getPageContactUs"},{"host":null,"methods":["POST"],"uri":"contact-us","name":"home.contact-us","action":"App\Http\Controllers\Home\PageController@postPageContactUs"},{"host":null,"methods":["GET","HEAD"],"uri":"faq","name":"home.faq","action":"App\Http\Controllers\Home\PageController@pageFaq"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin","name":"admin.index","action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting","name":"admin.setting","action":"App\Http\Controllers\Admin\DashboardController@getSetting"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/datatables\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.datatables","action":"App\Http\Controllers\Admin\UserController@getDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.list","action":"App\Http\Controllers\Admin\UserController@getList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/users\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.listdata","action":"App\Http\Controllers\Admin\UserController@getUsers"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/customers\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\UserController@getCustomers"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/delete\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.delete","action":"App\Http\Controllers\Admin\UserController@getDelete"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/create\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.create.post","action":"App\Http\Controllers\Admin\UserController@postCreate"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/edit\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.edit.post","action":"App\Http\Controllers\Admin\UserController@postEdit"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/update-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\UserController@postUpdateCourt"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/users\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\UserController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/teacher\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.listAll","action":"App\Http\Controllers\Admin\TeacherController@getList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/teacher\/teachers\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.listdata","action":"App\Http\Controllers\Admin\TeacherController@getTeachers"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/teacher\/list-for-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.list","action":"App\Http\Controllers\Admin\TeacherController@getListForBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/teacher\/delete\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.delete","action":"App\Http\Controllers\Admin\TeacherController@getDelete"},{"host":null,"methods":["POST"],"uri":"sadmin\/teacher\/create\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.create.post","action":"App\Http\Controllers\Admin\TeacherController@postCreate"},{"host":null,"methods":["POST"],"uri":"sadmin\/teacher\/edit\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"teacher.edit.post","action":"App\Http\Controllers\Admin\TeacherController@postEdit"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/teacher\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\TeacherController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/customer\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"customer.listAll","action":"App\Http\Controllers\Admin\CustomerController@getList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/customer\/customers\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"customer.listdata","action":"App\Http\Controllers\Admin\CustomerController@getCustomers"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/customer\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\CustomerController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard","name":null,"action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/add-context\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"dashboard.context","action":"App\Http\Controllers\Admin\DashboardController@getAddContext"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/clubs\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"dashboard.clubs.list","action":"App\Http\Controllers\Admin\DashboardController@getClubs"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/setting\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\DashboardController@getSetting"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/dashboard\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\DashboardController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/manage-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.index","action":"App\Http\Controllers\Admin\ManageBookingController@getManageBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/search-players\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.players","action":"App\Http\Controllers\Admin\ManageBookingController@getSearchPlayers"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/check-playerfor-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.checkPlayerforBooking","action":"App\Http\Controllers\Admin\ManageBookingController@postCheckPlayerforBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/info-grid-available\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.infoGridAvailable","action":"App\Http\Controllers\Admin\ManageBookingController@getInfoGridAvailable"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/make-time-unavailable\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.makeTimeUnavailable","action":"App\Http\Controllers\Admin\ManageBookingController@postMakeTimeUnavailable"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/cancel-unavailable\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.cancelUnavailable","action":"App\Http\Controllers\Admin\ManageBookingController@getCancelUnavailable"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/info-grid-for-deal\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.getInfoGridForDeal","action":"App\Http\Controllers\Admin\ManageBookingController@getInfoGridForDeal"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/new-deal\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.newDeal","action":"App\Http\Controllers\Admin\ManageBookingController@postNewDeal"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/data-of-date-of-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\ManageBookingController@getDataOfDateOfClub"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/data-of-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.dataOfClub","action":"App\Http\Controllers\Admin\ManageBookingController@getDataOfClub"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/view-price-order\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.viewPriceOrder","action":"App\Http\Controllers\Admin\ManageBookingController@postViewPriceOrder"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/check-court-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.postCheckCourtBooking","action":"App\Http\Controllers\Admin\ManageBookingController@postCheckCourtBooking"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/check-input-customer\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.checkInputCustomer","action":"App\Http\Controllers\Admin\ManageBookingController@postCheckInputCustomer"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/payment\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.postPayment","action":"App\Http\Controllers\Admin\ManageBookingController@postPayment"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/view\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.view","action":"App\Http\Controllers\Admin\ManageBookingController@getView"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/search\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.search","action":"App\Http\Controllers\Admin\ManageBookingController@getSearch"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/accept-payment\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.acceptPayment","action":"App\Http\Controllers\Admin\ManageBookingController@getAcceptPayment"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/cancel\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.cancel","action":"App\Http\Controllers\Admin\ManageBookingController@getCancel"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/address-lookup\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.address_lookup","action":"App\Http\Controllers\Admin\ManageBookingController@getAddressLookup"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/customer-lookup\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.customer_lookup","action":"App\Http\Controllers\Admin\ManageBookingController@getCustomerLookup"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/print-receipt\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.printReceipt","action":"App\Http\Controllers\Admin\ManageBookingController@postPrintReceipt"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/check-in\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.check-in","action":"App\Http\Controllers\Admin\ManageBookingController@getCheckIn"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/client-token\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.getClientToken","action":"App\Http\Controllers\Admin\ManageBookingController@getClientToken"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/booking\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ManageBookingController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/setting\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.setting","action":"App\Http\Controllers\Admin\ClubController@getSetting"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/courts\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.list","action":"App\Http\Controllers\Admin\ClubController@getCourts"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/list-days\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.listdays","action":"App\Http\Controllers\Admin\ClubController@getListDays"},{"host":null,"methods":["POST"],"uri":"sadmin\/clubs\/set-event-day\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.setEventDay","action":"App\Http\Controllers\Admin\ClubController@postSetEventDay"},{"host":null,"methods":["POST"],"uri":"sadmin\/clubs\/set-open-day\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.setOpenDay","action":"App\Http\Controllers\Admin\ClubController@postSetOpenDay"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/manager-bookings\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.manager-bookings","action":"App\Http\Controllers\Admin\ClubController@getManagerBookings"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/states\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.states","action":"App\Http\Controllers\Admin\ClubController@getStates"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/citys\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.citys","action":"App\Http\Controllers\Admin\ClubController@getCitys"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/clubs\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ClubController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/courts\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.list","action":"App\Http\Controllers\Admin\CourtController@getList"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/create-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.create","action":"App\Http\Controllers\Admin\CourtController@postCreateCourt"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/update-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.update","action":"App\Http\Controllers\Admin\CourtController@postUpdateCourt"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/update-courts\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.update.multi","action":"App\Http\Controllers\Admin\CourtController@postUpdateCourts"},{"host":null,"methods":["DELETE"],"uri":"sadmin\/courts\/court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.delete","action":"App\Http\Controllers\Admin\CourtController@deleteCourt"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/courts\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\CourtController@missingMethod"},{"host":null,"methods":["POST"],"uri":"sadmin\/contracts\/create-contract\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.create","action":"App\Http\Controllers\Admin\ContractController@postCreateContract"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/contracts\/list-contract\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.list","action":"App\Http\Controllers\Admin\ContractController@getListContract"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/contracts\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.listContract","action":"App\Http\Controllers\Admin\ContractController@getList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/contracts\/view\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.getView","action":"App\Http\Controllers\Admin\ContractController@getView"},{"host":null,"methods":["POST"],"uri":"sadmin\/contracts\/update-contract\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.update","action":"App\Http\Controllers\Admin\ContractController@postUpdateContract"},{"host":null,"methods":["DELETE"],"uri":"sadmin\/contracts\/contract\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"contracts.delete","action":"App\Http\Controllers\Admin\ContractController@deleteContract"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/contracts\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ContractController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/surface\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"surface.list","action":"App\Http\Controllers\Admin\SurfaceController@getList"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/surface\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\SurfaceController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/reports\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"reports.index","action":"App\Http\Controllers\Admin\ReportController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/reports","name":"reports.index","action":"App\Http\Controllers\Admin\ReportController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/reports\/data\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"reports.listdata","action":"App\Http\Controllers\Admin\ReportController@getData"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/reports\/download\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"reports.download","action":"App\Http\Controllers\Admin\ReportController@getDownload"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/reports\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ReportController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages","name":"admin.setting.pages","action":"App\Http\Controllers\Admin\Setting\PageController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages\/list","name":"admin.setting.pages.list","action":"App\Http\Controllers\Admin\Setting\PageController@getDataList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages\/create","name":"admin.setting.pages.create","action":"App\Http\Controllers\Admin\Setting\PageController@create"},{"host":null,"methods":["POST"],"uri":"sadmin\/setting\/pages\/create","name":"admin.setting.pages.create","action":"App\Http\Controllers\Admin\Setting\PageController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages\/edit-{id}","name":"admin.setting.pages.edit","action":"App\Http\Controllers\Admin\Setting\PageController@edit"},{"host":null,"methods":["POST"],"uri":"sadmin\/setting\/pages\/edit-{id}","name":"admin.setting.pages.edit","action":"App\Http\Controllers\Admin\Setting\PageController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages\/delete-{id}","name":"admin.setting.pages.delete","action":"App\Http\Controllers\Admin\Setting\PageController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/pages\/{id}","name":"admin.setting.pages.show","action":"App\Http\Controllers\Admin\Setting\PageController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq","name":"admin.setting.faq","action":"App\Http\Controllers\Admin\Setting\FaqController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq\/list","name":"admin.setting.faq.list","action":"App\Http\Controllers\Admin\Setting\FaqController@getDataList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq\/create","name":"admin.setting.faq.create","action":"App\Http\Controllers\Admin\Setting\FaqController@create"},{"host":null,"methods":["POST"],"uri":"sadmin\/setting\/faq\/create","name":"admin.setting.faq.create","action":"App\Http\Controllers\Admin\Setting\FaqController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq\/edit-{id}","name":"admin.setting.faq.edit","action":"App\Http\Controllers\Admin\Setting\FaqController@edit"},{"host":null,"methods":["POST"],"uri":"sadmin\/setting\/faq\/edit-{id}","name":"admin.setting.faq.edit","action":"App\Http\Controllers\Admin\Setting\FaqController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq\/delete-{id}","name":"admin.setting.faq.delete","action":"App\Http\Controllers\Admin\Setting\FaqController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/faq\/{id}","name":"admin.setting.faq.show","action":"App\Http\Controllers\Admin\Setting\FaqController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/contacts","name":"admin.setting.contacts","action":"App\Http\Controllers\Admin\Setting\ContactController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/contacts\/list","name":"admin.setting.contacts.list","action":"App\Http\Controllers\Admin\Setting\ContactController@getDataList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/contacts\/delete-{id}","name":"admin.setting.contacts.delete","action":"App\Http\Controllers\Admin\Setting\ContactController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/setting\/contacts\/{id}","name":"admin.setting.contacts.show","action":"App\Http\Controllers\Admin\Setting\ContactController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.index","action":"App\Http\Controllers\Admin\SuperAdminController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super","name":"super.index","action":"App\Http\Controllers\Admin\SuperAdminController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super\/clubs\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.list","action":"App\Http\Controllers\Admin\SuperAdminController@getClubs"},{"host":null,"methods":["POST"],"uri":"sadmin\/super\/create-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.create","action":"App\Http\Controllers\Admin\SuperAdminController@postCreateClub"},{"host":null,"methods":["PUT"],"uri":"sadmin\/super\/edit-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.edit","action":"App\Http\Controllers\Admin\SuperAdminController@putEditClub"},{"host":null,"methods":["DELETE"],"uri":"sadmin\/super\/club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.delete","action":"App\Http\Controllers\Admin\SuperAdminController@deleteClub"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/super\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\SuperAdminController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/social\/{driver}\/callback","name":"auth.social.callback","action":"App\Http\Controllers\Auth\AuthController@handleProviderCallback"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/social\/{driver}","name":"auth.social","action":"App\Http\Controllers\Auth\AuthController@redirectToProvider"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"auth.logout-home","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["POST"],"uri":"login","name":"auth.login-home","action":"App\Http\Controllers\Auth\AuthController@ajaxlogin"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@forgetpassword"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token?}","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@userresetpassword"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"auth.password.email","action":"App\Http\Controllers\Auth\PasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"verify","name":"verify","action":"App\Http\Controllers\Auth\AuthController@getVerify"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"sadmin\/login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/logout","name":"auth.logout","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/password\/reset\/{token?}","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"sadmin\/password\/email","name":"auth.password.email","action":"App\Http\Controllers\Auth\PasswordController@sendResetLinkEmail"},{"host":null,"methods":["POST"],"uri":"sadmin\/password\/reset","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@reset"}],
            prefix: '',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                return this.getCorrectUrl(uri + qs);
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if(!this.absolute)
                    return url;

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

