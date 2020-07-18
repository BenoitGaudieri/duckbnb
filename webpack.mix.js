const mix = require("laravel-mix");

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

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/show-map.js", "public/js")
    .js("resources/js/place-create.js", "public/js")
    .js("resources/js/search.js", "public/js")
    .js("resources/js/select.js", "public/js")
    .js("resources/js/views-chart.js", "public/js")
    .js("resources/js/sponsorship.js", "public/js")
    .js("resources/js/file-input.js", "public/js")
    .sass("resources/sass/app.scss", "public/css");
