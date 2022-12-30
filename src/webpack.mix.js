const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/main.js', 'public/js').vue()
    .postCss('resources/css/app.css', 'public/css', [
        // require('postcss-import'),
        require('tailwindcss'),
        // require('autoprefixer'),
    ])
    // .sass('resources/sass/app.scss', 'public/css')
    .browserSync({
        files: ['./resources/views/**/*', './public/**/*'],
        proxy: {
            target: 'web'
        },
        open: true,
        reloadOnRestart: true,
    })
    .version();

