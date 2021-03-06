var del    = require('del');
var gulp   = require('gulp');
var shell  = require('gulp-shell');
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
elixir.extend('del', function(paths) {
  gulp.task('del', function() {
    del(paths, function(err) {
      console.log('Deleted files/folders:\n', paths.join('\n'));
    });
  });

  return this.queueTask('del');
});

elixir(function(mix) {
    // 编译 resource/assets/less/app.less
    mix.less('app.less')
       .coffee()
       // 删除
       .del(['public/css/*.css', 'public/js/*.js'])
       // 复制
       .copy('resources/images', 'public/images')
       .copy('vendor/bower_components/fontawesome/fonts', 'public/fonts')
       // 复制所有的 css 到 public/css 中
       .copy('resources/assets/css', 'public/css')
       // 复制所有 js 到 public/js 中
       .copy('resources/assets/js', 'public/js')
       // 合并 public/css/*.css >> public/css/all.css
       .stylesIn('public/css', 'public/css/all.css')
       // 合并 vendor/bower_components/*.js
       .scripts([
           'jquery/dist/jquery.js',
           'bootstrap/dist/js/bootstrap.js',
           'jquery-form/jquery.form.js'
       ], 'public/js/vendor.js', elixir.config['bowerDir'])
       // 合并自定义 js
       .scriptsIn('public/js', 'public/js/all.js')
       .phpUnit()
       .phpSpec();
});

gulp.task('prepare', function () {
  gulp.src('').pipe(shell('composer update'))
              .pipe(shell('bower install'))
              .pipe(shell('php artisan migrate'))
              .pipe(shell('php artisan db:seed'))
              .pipe(shell('gulp'));
});
