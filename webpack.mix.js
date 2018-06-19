let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/admin.js', 'public/js')
    .js('resources/assets/js/select2.min.js', 'public/js')

    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/admin.scss', 'public/css')
    .sass('resources/assets/sass/timeline.scss', 'public/css');


mix.copy('node_modules/chart.js/Chart.js', 'public/js');
mix.copy('node_modules/bootbox/bootbox.js', 'public/js');
mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js');

mix.copy('resources/assets/css/select2.min.css', 'public/css');

