var elixir = require('laravel-elixir');
var gulp   = require('gulp');
 watch = require('gulp-watch');

require('laravel-elixir-vueify');
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
    elixir.config.assetsPath = 'resources/assets/auth/';
    elixir.config.publicPath = 'public/resources/auth/';
    var dist = './public/resources/auth/';
    elixir(function(mix) {
        mix.sass('auth.scss');
        mix.scripts('auth.js');
    });
});
gulp.task('admin', function() {
    elixir.config.assetsPath = 'resources/assets/admin/';
    elixir.config.publicPath = 'public/resources/admin/';
    elixir(function(mix) {
         mix.sass('admin.scss');
        // mix.scripts('admin.js');
         mix.browserify('app_modules/app.js','public/resources/admin/js/app_modules/app.js');
        // mix.scripts('app_modules/datatables.js');
        // mix.scripts('app_modules/avatar.js');
        // mix.scripts('app_modules/user.js');
    });
});

gulp.task('home', function() {
    elixir.config.assetsPath = 'resources/assets/home/';
    elixir.config.publicPath = 'public/resources/home/';
    elixir(function(mix) {
        mix.styles('home.css');
        mix.scripts('home.js');
    });
});
gulp.task('default', [ 'admin']);