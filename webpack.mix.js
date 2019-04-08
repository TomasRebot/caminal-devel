const mix = require('laravel-mix');

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

mix.styles([
    'resources/assets/css/bootstrap.css',
    'resources/assets/css/font-awesome.css',
    'resources/assets/css/custom.css',
], 'public/css/all.css')
.scripts([
    'resources/assets/js/jquery.js',
    'resources/assets/js/bootstrap.js',
    'resources/assets/js/custom.js',

],'public/js/all.js')

.js('resources/js/app.js', 'public/js/app.js');
