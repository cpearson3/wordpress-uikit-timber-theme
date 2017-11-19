'use strict';

// set paths
var config = {
    sassPaths: [
        './bootsmooth/sass/',
        './scss/'
    ],
    jsPaths: [
      './js/scripts.js'
    ]
};

// dependency requirements
var gulp   = require('gulp'),
    sass   = require('gulp-sass'),
    rename = require('gulp-rename'),
    csso = require('gulp-csso'),
	babelify = require('babelify'),
    browserify = require("browserify"),
    connect = require("gulp-connect"),
    source = require("vinyl-source-stream");

// Styles task
gulp.task('stylesheet', function () {
  return gulp.src('./scss/style.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(rename('style.css'))
    .pipe(gulp.dest('./'));
});

// Javascript  task
gulp.task('javascript', function() {
   return browserify({
        entries: ["./js/scripts.js"]
    })
    .transform(babelify.configure({
        presets : ["es2015"]
    }))
    .bundle()
    .pipe(source("build.js"))
    .pipe(gulp.dest("./dist"))
  ;
});

// Watch tasks
gulp.task('watch', ['build'], function() {
    // styles
    gulp.watch(['./scss/**/*.scss', './bootsmooth/scss/**/*.scss'], [
        'stylesheet'
    ]);
    
    // js
    gulp.watch(['./js/**/*.js'], [
        'javascript'
    ]);
});

// build task
gulp.task('build', ['stylesheet', 'javascript']);

// default task
gulp.task('default', ['watch']);