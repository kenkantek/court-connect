var elixir = require('laravel-elixir');
var gulp   = require('gulp');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;
elixir.config.production = true;

gulp.task('auth', function() {

    var path = {'src': './resources/assets/auth/', 'dist': './public/resources/auth/'};

    elixir(function(mix) {

        mix.sass(
            path.src + 'sass/auth.scss',
            path.dist + 'css/auth.css'
        );

        mix.scripts(
            path.src + 'js/auth.js',
            path.dist + 'js/auth.js'
        );

    });
});


gulp.task('admin', function() {

    var path = {'src': './resources/assets/admin/', 'dist': './public/resources/admin/'};

    elixir(function(mix) {

        mix.sass(
            path.src + 'sass/admin.scss',
            path.dist + 'css/admin.css'
        );

        mix.scripts(
            path.src + 'js/admin.js',
            path.dist + 'js/admin.js'
        );

        mix.scripts(
            path.src + 'js/app_modules/datatables.js',
            path.dist + 'js/app_modules/datatables.js'
        );

        mix.scripts(
            path.src + 'js/app_modules/avatar.js',
            path.dist + 'js/app_modules/avatar.js'
        );
        mix.scripts(
            path.src + 'js/app_modules/user.js',
            path.dist + 'js/app_modules/user.js'
        );

    });
});

gulp.task('home', function() {

    var path = {'src': './resources/assets/home/', 'dist': './public/resources/home/'};

    elixir(function(mix) {

        mix.styles(
            path.src + 'css/home.css',
            path.dist + 'css/home.css'
        );

        mix.scripts(
            path.src + 'js/home.js',
            path.dist + 'js/home.js'
        );

    });
});

gulp.task('default', ['auth', 'admin', 'home']);
