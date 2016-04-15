<?php
/**
 * Created by Sublime Text 3.
 * User: Sang Nguyen
 * Date: 22/07/2015
 * Time: 8:11 PM
 */

return [
    'offline' => false,
    // set to false to enable use of individual use_cdn settings.  Set to true to load everything from local sources
    'app_module_path' => public_path() . '/resources/admin/js/app_modules/',
    'admin' => [
        'javascript' => [
            'jquery',
            'csrf',
            'laroute',
            'bootstrap',
            'adminlte',
            'toastr',
            'pace',
            'uniform',
            'admin',
        ],
        'stylesheets' => [
            'bootstrap',
            'font-awesome',
            'ionicons',
            'pace',
            'toastr',
        ],
    ],
    'auth' => [
        'javascript' => [
            'jquery',
            'bootstrap',
            'adminlte',
            'uniform',
            'toastr',
            'auth',
        ],
        'stylesheets' => [
            'bootstrap',
            'font-awesome',
            'uniform',
            'adminlte',
            'toastr',
            'auth',
        ],
    ],
    'home' => [
        'javascript' => [
            'jquery',
            'csrf',
            'bootstrap',
            'jquery-ui',
            'jquery-ui-slider',
            'jquery-ui-timepicker',
            'jquery-ui-multidatespicker',
            'ionslider',
            'home',
            'city-autocomplete',
        ],
        'stylesheets' => [
            'bootstrap',
            'fontawesome',
            'jquery-ui',
            'jquery-ui-timepicker',
            'home',
            'ionslider',
            'autocomplete'
        ],
    ],
    'resources' => [
        'javascript' => [
            'jquery' => [
                'use_cdn' => true,
                'fallback' => 'jQuery',
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/jquery/jquery.min.js',
                    'cdn' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',
                ],
            ],
            'bootstrap-fileinput' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' =>
                    [
                        '/resources/vendor/bootstrap-fileinput/js/fileinput.min.js',
                        '/resources/vendor/bootstrap-fileinput/js/plugins/canvas-to-blob.min.js',
                    ],
                    'cdn' => '',
                ],
            ],
            'csrf' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/csrf.js',
                    'cdn' => '',
                ],
            ],
            'laroute' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/routes.js',
                ],
            ],
            'jquery-slider' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/jquery-slider/jquery.slider.min.js',
                ],
            ],
            'city-autocomplete' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/home/js/jquery.city-autocomplete.js',
                ],
            ],
            'bootstrap' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/bootstrap/js/bootstrap.min.js',
                    'cdn' => '',
                ],
            ],
            'jquery-ui' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/jquery-ui/jquery-ui.min.js',
                    'cdn' => '',
                ],
            ],
            'jquery-ui-slider' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/jquery-ui-slider/jquery-ui-sliderAccess.js',
                    'cdn' => '',
                ],
            ],
            'jquery-ui-multidatespicker' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/jquery-ui-multidatespicker/js/jquery-ui.multidatespicker.js',
                    'cdn' => '',
                ],
            ],
            'jquery-ui-timepicker' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => [
                        '/resources/vendor/jquery-ui-timepicker/js/jquery-ui-timepicker-addon.min.js',
                        '/resources/vendor/jquery-ui-timepicker/js/jquery-ui-timepicker-addon-i18n.min.js',
                    ],
                    'cdn' => '',
                ],
            ],
            'home' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/home/js/home.js',
                    'cdn' => '',
                ],
            ],
            'select2' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/select2/select2.full.min.js',
                    'cdn' => '',
                ],
            ],
            'timepicker' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/timepicker/js/bootstrap-timepicker.js',
                    'cdn' => '',
                ],
            ],
            'datetimepicker' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/datetimepicker/build/js/bootstrap-datetimepicker.min.js',
                    'cdn' => '',
                ],
            ],
            'daterangepicker' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => [
                        '/resources/vendor/daterangepicker/daterangepicker.js',
                        '/resources/vendor/daterangepicker/moment.min.js',
                    ],
                    'cdn' => '',
                ],
            ],
            'moment' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/moment/min/moment.min.js',
                    'cdn' => '',
                ],
            ],
            'monthly' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/monthly/monthly.js',
                    'cdn' => '',
                ],
            ],
            'adminlte' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => [
                        '/resources/vendor/adminlte/js/AdminLTE.js',
                        '/resources/vendor/adminlte/js/layout.js',
                    ],
                    'cdn' => '',
                ],
            ],
            'admin' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/admin/js/admin.js',
                    'cdn' => '',
                ],
            ],
            'auth' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/auth/js/auth.js',
                    'cdn' => '',
                ],
            ],
            'toastr' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => ['/resources/vendor/bootstrap-toastr/toastr.js'],
                    'cdn' => [''],
                ],
            ],
            'pace' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => ['/resources/vendor/pace/pace.min.js'],
                    'cdn' => [''],
                ],
            ],
            'uniform' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => ['/resources/vendor/uniform/jquery.uniform.min.js'],
                    'cdn' => [''],
                ],
            ],
            'datatables' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => [
                        '/resources/vendor/datatables/media/js/jquery.dataTables.min.js',
                        '/resources/vendor/datatables/extensions/ColReorder/js/dataTables.colReorder.min.js',
                        '/resources/vendor/datatables/plugins/bootstrap/dataTables.bootstrap.js',
                    ],
                    'cdn' => [''],
                ],
            ],
            'bootstrap-multiselect' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/bootstrap-multiselect/bootstrap-multiselect.js',
                    'cdn' => '',
                ],
            ],
            'ionslider' => [
                'use_cdn' => false,
                'location' => 'bottom',
                'src' => [
                    'local' => '/resources/vendor/ionslider/ion.rangeSlider.min.js',
                    'cdn' => '',
                ],
            ],
            // End JS
        ],
        /* -- STYLESHEET ASSETS -- */
        'stylesheets' => [
            'bootstrap' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/bootstrap/css/bootstrap.min.css',
                ],
            ],
            'fontawesome' => [
                'use_cdn' => true,
                'location' => 'top',
                'src' => [
                    'local' => '',
                    'cdn' => '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
                ],
            ],
            'jquery-ui' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/jquery-ui/jquery-ui.css',
                ],
            ],
            'jquery-ui-timepicker' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/jquery-ui-timepicker/css/jquery-ui-timepicker-addon.css',
                ],
            ],
            'home' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/home/css/home.css',
                ],
            ],
            'autocomplete' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/home/css/autocomplete.css',
                ],
            ],
            'font-awesome' => [
                'use_cdn' => true,
                'location' => 'top',
                'src' => [
                    'local' => '',
                    'cdn' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
                ],
            ],
            'ionicons' => [
                'use_cdn' => true,
                'location' => 'top',
                'src' => [
                    'local' => '',
                    'cdn' => 'http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css',
                ],
            ],
            'jquery-slider' => [
                'use_cdn' => true,
                'location' => 'top',
                'src' => [
                    'local' => '',
                    'cdn' => '/resources/vendor/jquery-slider/jquery.slider.min.css',
                ],
            ],
            'adminlte' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => [
                        '/resources/vendor/adminlte/css/AdminLTE.min.css',
                        '/resources/vendor/adminlte/css/skins/_all-skins.min.css',
                    ],
                    'cdn' => '',
                ],
            ],
            'select2' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/select2/select2.min.css',
                    'cdn' => '',
                ],
            ],
            'timepicker' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/timepicker/css/bootstrap-timepicker.css',
                    'cdn' => '',
                ],
            ],
            'datetimepicker' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/datetimepicker/build/css/bootstrap-datetimepicker.min.css',
                    'cdn' => '',
                ],
            ],
            'daterangepicker' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/daterangepicker/daterangepicker-bs3.css',
                    'cdn' => '',
                ],
            ],
            'monthly' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/monthly/monthly.css',
                    'cdn' => '',
                ],
            ],
            'admin' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/admin/css/admin.css',
                    'cdn' => '',
                ],
            ],
            'custom' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/admin/css/custom.css',
                    'cdn' => '',
                ],
            ],
            'auth' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/auth/css/auth.css',
                ],
            ],
            'toastr' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => ['/resources/vendor/bootstrap-toastr/toastr.min.css'],
                    'cdn' => [],
                ],
            ],
            'pace' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => ['/resources/vendor/pace/themes/pace-theme-minimal.css'],
                    'cdn' => [],
                ],
            ],
            'uniform' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => ['/resources/vendor/uniform/css/uniform.default.min.css'],
                    'cdn' => [],
                ],
            ],
            'bootstrap-fileinput' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => ['/resources/vendor/bootstrap-fileinput/css/fileinput.min.css'],
                    'cdn' => [],
                ],
            ],
            'datatables' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => [
                        '/resources/vendor/datatables/extensions/Scroller/css/dataTables.scroller.min.css',
                        '/resources/vendor/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css',
                        '/resources/vendor/datatables/plugins/bootstrap/dataTables.bootstrap.css',
                    ],
                    'cdn' => [],
                ],
            ],
            'bootstrap-multiselect' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/bootstrap-multiselect/bootstrap-multiselect.css',
                    'cdn' => '',
                ],
            ],
            'ionslider' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => ['/resources/vendor/ionslider/ion.rangeSlider.css', '/resources/vendor/ionslider/ion.rangeSlider.skinNice.css'],
                    'cdn' => '',
                ],
            ],
        ],
    ],
];
