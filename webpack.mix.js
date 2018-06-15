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

// mix.scripts([
//     'resources/assets/js/jquery.js',
//     'resources/assets/js/app.js',
//     'resources/assets/js/admin.js',
//     'resources/assets/js/toastr.js',
//     'resources/assets/js/datatables.min.js',
//     'node_modules/bootbox/bootbox.js',
//     'node_modules/bootstrap-sass/assets/javascripts/bootstrap.js',
//     'node_modules/bootstrap-select/dist/js/bootstrap-select.js',
//     ],'public/js/app.js');
//
// mix.styles([
//         'resources/assets/css/bootstrap.css',
//         'resources/assets/css/datatables.min.css',
//     ], 'public/css/complements.css');


mix
  .js('resources/assets/js/app.js', 'public/js')
  .js('resources/assets/js/admin.js', 'public/js')

  .sass('resources/assets/sass/app.scss', 'public/css')
  .sass('resources/assets/sass/admin.scss', 'public/css')
  .sass('resources/assets/sass/timeline.scss', 'public/css');


mix.copy('node_modules/chart.js/Chart.js', 'public/js');
mix.copy('node_modules/bootbox/bootbox.js', 'public/js');
mix.copy('node_modules/bootstrap-sass/assets/javascripts/bootstrap.js', 'public/js');
mix.copy('node_modules/bootstrap-select/dist/js/bootstrap-select.js', 'public/js');
mix.copy('resources/assets/js/toastr.js', 'public/js');


mix.copy('node_modules/bootstrap-select/dist/css/bootstrap-select.css', 'public/css');

