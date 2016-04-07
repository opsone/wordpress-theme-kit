
var gulp     = require('gulp'),
  jshint     = require('gulp-jshint'),
  uglify     = require('gulp-uglify'),
  sourcemaps = require('gulp-sourcemaps'),
  sass       = require('gulp-sass'),
  cssnano    = require('gulp-cssnano'),
  concat     = require('gulp-concat'),
  watch      = require('gulp-watch'),
  del        = require('del'),
  paths      = require('./config').paths
;

var uglifyjs = function(path){
  return gulp.src(path.scripts)
    .pipe(sourcemaps.init())
    .pipe(uglify())
    .pipe(concat('scripts.min.js'))
    .pipe(sourcemaps.write('../dist'))
    .pipe(gulp.dest(path.dist))
  ;
};

var minifycss = function(path){
  gulp.src(path.styles)
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(concat('styles.min.css'))
    .pipe(cssnano())
    .pipe(sourcemaps.write('../dist'))
    .pipe(gulp.dest(path.dist))
  ;
};

// Clean dist folder
gulp.task('clean:scripts', function (c) {
  del(paths.admin.dist + '/*.js', c);
  return del(paths.front.dist + '/*.js', c);
});
gulp.task('clean:styles', function (c) {
  del(paths.admin.dist + '/*.css', paths.admin.dist + '/*.map');
  return del(paths.front.dist + '/*.css', paths.front.dist + '/*.map');
});

// Check scripts validity
gulp.task('lint', function () {
  gulp.src(paths.admin.scripts)
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
  ;

  return gulp.src(paths.front.scripts)
    .pipe(jshint())
    .pipe(jshint.reporter('default'))
  ;
});

// Scripts
gulp.task('scripts', ['clean:scripts'], function () {
  uglifyjs(paths.admin);
  return uglifyjs(paths.front);
});

// Stylesheets
gulp.task('styles', ['clean:styles'], function () {
  minifycss(paths.admin);
  return minifycss(paths.front);
});

// Sort tasks
gulp.task('build', [
  'lint',
  'scripts',
  'styles'
]);

// Watch
gulp.task('watch', function () {
  gulp.watch(paths.front.scripts, ['lint', 'scripts'])
    .on('change', function(event){
      console.log('* ' + event.path + ' is update');
  });
  gulp.watch(paths.admin.scripts, ['lint', 'scripts'])
    .on('change', function(event){
      console.log('* ' + event.path + ' is update');
  });

  gulp.watch(paths.front.styles, ['styles'])
    .on('change', function(event){
      console.log('* ' + event.path + ' is update');
  });
  gulp.watch(paths.admin.styles, ['styles'])
    .on('change', function(event){
      console.log('* ' + event.path + ' is update');
  });
});

gulp.task('serve', ['build', 'watch']);
