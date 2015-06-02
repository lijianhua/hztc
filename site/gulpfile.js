var gulp   = require("gulp");
var shell  = require("gulp-shell");
var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
elixir(function(mix) {
    // 编译 resource/assets/less/app.less
    mix.less('app.less')
        // 复制
       .copy("resources/assets/css/public.css", "public/css/public.css")
       .copy("resources/images", "public/images")
       .copy("vendor/bower_components/fontawesome/fonts", "public/fonts")
       // 合并 public/css/*.css >> public/css/all.css
       .styles([
           "app.css",
           "public.css"
       ], "public/css/all.css", "public/css")
       // 合并 vendor/bower_components/*.js
       .scripts([
           "jquery/dist/jquery.js",
           "bootstrap/dist/js/bootstrap.js"
       ], "public/js/vendor.js", elixir.config["bowerDir"])
       // 合并自定义 js
       .scripts([
           "home.js"
       ], "public/js/app.js")
       .phpUnit()
       .phpSpec();
});

gulp.task("prepare", function () {
  gulp.src("").pipe(shell("composer update"))
              .pipe(shell("bower install"))
              .pipe(shell("php artisan migrate"))
              .pipe(shell("php artisan db:seed"))
              .pipe(shell("gulp"));
});
