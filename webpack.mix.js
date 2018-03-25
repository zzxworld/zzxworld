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

let jsResources = ['app', 'notes', 'task_boards'];
let cssResources = ['app', 'notes', 'task_boards'];

jsResources.forEach(function (name) {
    mix.js('resources/assets/js/'+name+'.js', 'public/js');
});

cssResources.forEach(function (name) {
    mix.sass('resources/assets/sass/'+name+'.scss', 'public/css');
});
