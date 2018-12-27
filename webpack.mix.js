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

mix.js('resources/assets/js/app.js', 'public/js')
// see https://github.com/JeffreyWay/laravel-mix/issues/1846#issuecomment-446723800
  .sass('resources/assets/sass/app.scss', 'public/css', { implementation: require('node-sass') });