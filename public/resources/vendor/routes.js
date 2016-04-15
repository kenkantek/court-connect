(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://localhost',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home.index","action":"App\Http\Controllers\Home\HomeController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"search","name":"home.search","action":"App\Http\Controllers\Home\SearchController@getSearch"},{"host":null,"methods":["POST"],"uri":"search","name":"home.search","action":"App\Http\Controllers\Home\SearchController@postSearch"},{"host":null,"methods":["GET","HEAD"],"uri":"signup","name":"home.signup","action":"App\Http\Controllers\Home\HomeController@getSignUp"},{"host":null,"methods":["POST"],"uri":"signup","name":"home.signup","action":"App\Http\Controllers\Home\HomeController@postSignUp"},{"host":null,"methods":["GET","HEAD"],"uri":"account\/{id}","name":"home.acouunt","action":"App\Http\Controllers\Home\HomeController@getAccount"},{"host":null,"methods":["POST"],"uri":"account\/{id}","name":"home.account","action":"App\Http\Controllers\Home\HomeController@updateAccount"},{"host":null,"methods":["POST"],"uri":"account\/setting\/password\/{id}","name":"home.account.setting.password","action":"App\Http\Controllers\Home\HomeController@updateSettingPassword"},{"host":null,"methods":["POST"],"uri":"account\/setting\/contact\/{id}","name":"home.account.setting.contact","action":"App\Http\Controllers\Home\HomeController@updateSettingContact"},{"host":null,"methods":["POST"],"uri":"account\/setting\/address\/{id}","name":"home.account.setting.address","action":"App\Http\Controllers\Home\HomeController@updateSettingAddress"},{"host":null,"methods":["GET","HEAD"],"uri":"checkout","name":"home.checkout","action":"App\Http\Controllers\Home\HomeController@showCheckout"},{"host":null,"methods":["POST"],"uri":"checkout","name":"home.checkout","action":"App\Http\Controllers\Home\HomeController@postCheckout"},{"host":null,"methods":["GET","HEAD"],"uri":"search\/autocomplete","name":null,"action":"App\Http\Controllers\Home\SearchController@autocomplete"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin","name":"admin.index","action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/datatables\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.datatables","action":"App\Http\Controllers\Admin\UserController@getDatatables"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/list1\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\UserController@getList1"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.list","action":"App\Http\Controllers\Admin\UserController@getList"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/users\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.listdata","action":"App\Http\Controllers\Admin\UserController@getUsers"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/users\/delete\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.delete","action":"App\Http\Controllers\Admin\UserController@getDelete"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/create\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.create.post","action":"App\Http\Controllers\Admin\UserController@postCreate"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/edit\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"users.edit.post","action":"App\Http\Controllers\Admin\UserController@postEdit"},{"host":null,"methods":["POST"],"uri":"sadmin\/users\/update-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\UserController@postUpdateCourt"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/users\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\UserController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/setting\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.setting","action":"App\Http\Controllers\Admin\ClubController@getSetting"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/courts\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.list","action":"App\Http\Controllers\Admin\ClubController@getCourts"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/list-days\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.listdays","action":"App\Http\Controllers\Admin\ClubController@getListDays"},{"host":null,"methods":["POST"],"uri":"sadmin\/clubs\/set-event-day\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.setEventDay","action":"App\Http\Controllers\Admin\ClubController@postSetEventDay"},{"host":null,"methods":["POST"],"uri":"sadmin\/clubs\/set-open-day\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.courts.setOpenDay","action":"App\Http\Controllers\Admin\ClubController@postSetOpenDay"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/manager-bookings\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.manager-bookings","action":"App\Http\Controllers\Admin\ClubController@getManagerBookings"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/states\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.states","action":"App\Http\Controllers\Admin\ClubController@getStates"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/clubs\/citys\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"clubs.citys","action":"App\Http\Controllers\Admin\ClubController@getCitys"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/clubs\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ClubController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/courts\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\CourtController@getList"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/create-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.create","action":"App\Http\Controllers\Admin\CourtController@postCreateCourt"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/update-court\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.update","action":"App\Http\Controllers\Admin\CourtController@postUpdateCourt"},{"host":null,"methods":["POST"],"uri":"sadmin\/courts\/update-courts\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"courts.update.multi","action":"App\Http\Controllers\Admin\CourtController@postUpdateCourts"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/courts\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\CourtController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/surface\/list\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"surface.list","action":"App\Http\Controllers\Admin\SurfaceController@getList"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/surface\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\SurfaceController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard","name":null,"action":"App\Http\Controllers\Admin\DashboardController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/add-context\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"dashboard.context","action":"App\Http\Controllers\Admin\DashboardController@getAddContext"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/dashboard\/clubs\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"dashboard.clubs.list","action":"App\Http\Controllers\Admin\DashboardController@getClubs"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/dashboard\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\DashboardController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/manage-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.index","action":"App\Http\Controllers\Admin\ManageBookingController@getManageBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/data-of-date-of-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":null,"action":"App\Http\Controllers\Admin\ManageBookingController@getDataOfDateOfClub"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/data-of-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.dataOfClub","action":"App\Http\Controllers\Admin\ManageBookingController@getDataOfClub"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/view-price-order\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.viewPriceOrder","action":"App\Http\Controllers\Admin\ManageBookingController@getViewPriceOrder"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/check-input-booking\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.checkInputBooking","action":"App\Http\Controllers\Admin\ManageBookingController@getCheckInputBooking"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/check-input-customer\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.checkInputCustomer","action":"App\Http\Controllers\Admin\ManageBookingController@getCheckInputCustomer"},{"host":null,"methods":["POST"],"uri":"sadmin\/booking\/check-input-payment\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.checkInputPayment","action":"App\Http\Controllers\Admin\ManageBookingController@postCheckInputPayment"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/view\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.view","action":"App\Http\Controllers\Admin\ManageBookingController@getView"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/booking\/accept-payment\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"booking.acceptPayment","action":"App\Http\Controllers\Admin\ManageBookingController@getAcceptPayment"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/booking\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\ManageBookingController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super\/index\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.index","action":"App\Http\Controllers\Admin\SuperAdminController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super","name":"super.index","action":"App\Http\Controllers\Admin\SuperAdminController@getIndex"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/super\/clubs\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.list","action":"App\Http\Controllers\Admin\SuperAdminController@getClubs"},{"host":null,"methods":["POST"],"uri":"sadmin\/super\/create-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.create","action":"App\Http\Controllers\Admin\SuperAdminController@postCreateClub"},{"host":null,"methods":["PUT"],"uri":"sadmin\/super\/edit-club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.edit","action":"App\Http\Controllers\Admin\SuperAdminController@putEditClub"},{"host":null,"methods":["DELETE"],"uri":"sadmin\/super\/club\/{one?}\/{two?}\/{three?}\/{four?}\/{five?}","name":"super.clubs.delete","action":"App\Http\Controllers\Admin\SuperAdminController@deleteClub"},{"host":null,"methods":["GET","HEAD","POST","PUT","PATCH","DELETE"],"uri":"sadmin\/super\/{_missing}","name":null,"action":"App\Http\Controllers\Admin\SuperAdminController@missingMethod"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/facebook","name":"auth.facebook","action":"App\Http\Controllers\Auth\AuthController@redirectToProvider"},{"host":null,"methods":["GET","HEAD"],"uri":"auth\/facebook\/callback","name":"auth.social.confirm","action":"App\Http\Controllers\Auth\AuthController@handleProviderCallback"},{"host":null,"methods":["GET","HEAD"],"uri":"logout","name":"auth.logout-home","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["POST"],"uri":"login","name":"auth.login-home","action":"App\Http\Controllers\Auth\AuthController@ajaxlogin"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@forgetpassword"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token?}","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@userresetpassword"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"auth.password.email","action":"App\Http\Controllers\Auth\PasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"sadmin\/login","name":"auth.login","action":"App\Http\Controllers\Auth\AuthController@login"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/logout","name":"auth.logout","action":"App\Http\Controllers\Auth\AuthController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"sadmin\/password\/reset\/{token?}","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"sadmin\/password\/email","name":"auth.password.email","action":"App\Http\Controllers\Auth\PasswordController@sendResetLinkEmail"},{"host":null,"methods":["POST"],"uri":"sadmin\/password\/reset","name":"auth.password.reset","action":"App\Http\Controllers\Auth\PasswordController@reset"}],
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

