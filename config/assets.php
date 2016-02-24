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
        ],
        'stylesheets' => [
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
            'home',
        ],
        'stylesheets' => [
            'bootstrap',
            'fontawesome',
            'jquery-ui',
            'jquery-ui-timepicker',
            'home',
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
            'csrf' => [
                'use_cdn' => false,
                'location' => 'top',
                'src' => [
                    'local' => '/resources/vendor/csrf.js',
                    'cdn' => '',
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
                    'local' => '/resources/home/js/custom.js',
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
                    'local' => '/resources/home/css/custom.css',
                ],
            ],
        ],
    ],
];
