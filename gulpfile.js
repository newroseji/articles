var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix
        /* .sass('app.scss'); */

        .styles(
            [
                "/assets/css/ie10-viewport-bug-workaround.css",
                "/assets/sweetalert2/dist/sweetalert2.min.css",
                "/assets/lity.2.2.0/lity.min.css",
                "/assets/css/carousel.css",
                "/assets/css/styles.css"
            ],
            "public/css/styles.min.css",
            'public/'
        )
        .scripts(
            [
                "/assets/js/ie-emulation-modes-warning.js",
                "/assets/js/html5shiv.3.7.3.min.js",
                "/assets/js/respond.1.4.2.min.js",
                "/assets/js/jquery/1.12.4/jquery.min.js",
                "/assets/js/bootstrap.min.js",
                "/assets/js/holder.min.js",
                "/assets/js/ie10-viewport-bug-workaround.js",
                "/assets/sweetalert2/dist/sweetalert2.min.js",
                "/assets/lity.2.2.0/lity.min.js"
            ],
            "public/js/scripts.min.js",
            'public/'
        );
});
