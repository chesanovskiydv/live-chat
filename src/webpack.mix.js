const mix = require('laravel-mix');
require('laravel-mix-react-css-modules');

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

mix.copy('node_modules/emodal/dist', 'public/libs/emodal');

mix //.react('resources/assets/js/app.js', 'public/js')
    .react('resources/sdk/index.js', 'public/sdk')
    .ts('resources/assets/ts/macros/init.ts', 'public/js/macros.js')
    .ts('resources/assets/ts/clipboard.ts', 'public/js/clipboard.js')
    .sass('resources/assets/sass/macros/macros.scss', 'public/css')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .reactCSSModules('[local]_[hash:base64:8]')
;
