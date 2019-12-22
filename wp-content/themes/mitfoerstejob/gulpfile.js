"use strict";

var gulp 		= require('gulp');
var sass        = require('gulp-sass');
var sourcemaps 	= require('gulp-sourcemaps');
var cleancss    = require('gulp-clean-css');
var concat 		= require('gulp-concat');
var uglify 		= require('gulp-uglify');
var rename 		= require('gulp-rename');
var util 		= require('gulp-util');
var livereload 	= require('gulp-livereload');
var server 		= require('tiny-lr');
var jshint 		= require('gulp-jshint');
var del 		= require('del');

sass.compiler = require('node-sass');


// CSS task
function css() {
  return gulp
    .src('assets/scss/main.scss')
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(sourcemaps.write())
    .pipe(concat('main.css'))
    .pipe(gulp.dest('assets/dist/'))
    .pipe(cleancss())
    .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('assets/dist/'));
}


// Lint scripts
function lint() {
  return (
    gulp
      .src(['assets/js/*', 'gulpfile.js'])
      .pipe(jshint())
      .pipe(jshint.reporter('jshint-stylish'))
    );
}


// Transpile, concatenate and minify scripts
function scripts() {
  return (
    gulp
      .src(['assets/js/_*.js'])
      .pipe(concat('scripts.js'))
      .pipe(gulp.dest('assets/dist/'))
      .pipe(rename({suffix: '.min'}))
      .pipe(uglify())
      .pipe(gulp.dest( 'assets/dist/'))
  );
}


// Clean assets
function clean() {
  return del(['**/.DS_Store']);
}


// Watch files
function watchFiles() {
  gulp.watch('assets/scss/**/*.scss', css);
  gulp.watch('assets/js/_*.js', gulp.series(lint, scripts));
}



// define complex tasks
const js = gulp.series(lint, scripts);
const watch = gulp.parallel(watchFiles);
const build = gulp.series(clean, gulp.parallel(css, js, watch));

// export tasks
exports.css = css;
exports.js = js;
exports.clean = clean;
exports.build = build;
exports.watch = watch;
exports.default = build;
