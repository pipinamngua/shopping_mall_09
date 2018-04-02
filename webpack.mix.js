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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.copyDirectory('node_modules/bootstrap', 'public/css/admins/bootstrap');
mix.copyDirectory('node_modules/font-awesome', 'public/css/admins/font-awesome');
mix.copyDirectory('node_modules/jquery', 'public/js/admins/jquery');
mix.copyDirectory('resources/assets/images', 'public/images');
mix.copyDirectory('node_modules/toastr', 'public/library/customers/toastr');
mix.copyDirectory('resources/assets/css', 'public/css');
mix.copyDirectory('resources/assets/js/customers', 'public/js/customers');
