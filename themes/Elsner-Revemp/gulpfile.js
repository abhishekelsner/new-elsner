const gulp = require("gulp");
const sass = require("gulp-sass")(require("sass"));
const postcss = require("gulp-postcss");
const uglify = require("gulp-uglify");
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const rename = require("gulp-rename");
const gzip = require("gulp-gzip");

// Define tasks

// Example task to compile Sass
gulp.task("sass", function () {
  return gulp
    .src("src/scss/**/*.scss")
    .pipe(sass().on("error", sass.logError))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(gulp.dest("assets/css"));
});

// Example task to minify JavaScript
gulp.task("scripts", function () {
  return gulp
    .src("src/js/**/*.js")
    .pipe(uglify())
    .pipe(rename({ suffix: ".min" }))
    .pipe(gulp.dest("assets/js"));
});
gulp.task("icons", function () {
  return gulp
    .src("node_modules/@fortawesome/fontawesome-free/webfonts/*")
    .pipe(gulp.dest("assets//webfonts/"));
});

// Define a default task
gulp.task("default", gulp.parallel("sass", "icons", "scripts"));
