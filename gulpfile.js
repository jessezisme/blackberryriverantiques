const gulp = require('gulp');
const noop = require('gulp-noop');
const babel = require('gulp-babel');
const concat = require('gulp-concat');
const minify = require('gulp-minify');
const uglify = require('gulp-uglify');
const sass = require('gulp-sass');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('gulp-cssnano');

/*=============================================
=            config            =
=============================================*/
/**
 * set path and environment variables,
 * which are used to determine whether files should be minified, etc... *
 */
const config = {
  assets_src: './app/public/wp-content/themes/blackberry/src/',
  assets_dist: './app/public/wp-content/themes/blackberry/dist/',
  env: process.env.NODE_ENV === 'production' ? 'production' : 'development',
  env_prod: process.env.NODE_ENV === 'production' ? true : false,
};
console.log('Environment running in Gulp: ' + config.env);

/*=====  End of config  ======*/

/*=============================================
=            JS            =
=============================================*/
gulp.task('js', function () {
  return gulp
    .src([config.assets_src + 'js/main.js'], {
      base: config.assets_src,
    })
    .pipe(
      babel({
        presets: ['@babel/env'],
      })
    )
    .pipe(
      // only minifiy if in prod; run noop() to just pass stream through using noop()
      config.env_prod ? minify() : noop()
    )
    .pipe(concat('main.js'))
    .pipe(
      // only uglify if in prod; run noop() to just pass stream through using noop()
      config.env_prod ? uglify() : noop()
    )
    .pipe(gulp.dest(config.assets_dist + 'js'));
});
/*=====  End of JS  ======*/

/*=============================================
=            SCSS/CSS            =
=============================================*/
gulp.task('sass', function () {
  return gulp
    .src([config.assets_src + 'css/**/*.scss'], {
      base: config.assets_src,
    })
    .pipe(sass().on('error', sass.logError))
    .pipe(
      postcss([
        autoprefixer({
          overrideBrowserslist: ['last 10 versions'],
          cascade: false,
        }),
      ])
    )
    .pipe(cssnano())
    .pipe(gulp.dest(config.assets_dist));
});

/*=====  End of SCSS/CSS  ======*/

/*=============================================
=            Serve & Watch          =
=============================================*/
gulp.task('serve-watch', function () {
  gulp.watch(config.assets_src + 'js/*.js', gulp.series('js'));
  gulp.watch(config.assets_src + 'css/**/*.scss', gulp.series('sass'));
});

/*=====  End of Serve & Watch  ======*/

/*=============================================
=            Default            =
=============================================*/
gulp.task('build', gulp.series('js', 'sass'));
gulp.task('default', gulp.series('js', 'sass', 'serve-watch'));
/*=====  End of Default  ======*/
