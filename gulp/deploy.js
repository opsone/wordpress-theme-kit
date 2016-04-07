
var gulp  = require('gulp'),
    rsync = require('gulp-rsync');

gulp.task('deploy-staging', [], function(){
  return gulp.src('./')
    .pipe(rsync({
      root: './',
      hostname: 'hostname',
      username: 'username',
      destination: '/path',
      recursive: true,
      emptyDirectories: true,
      incremental: true,
      progress: true,
      silent:false,
      clean: true,
      exclude: ['.DS_Store', '.git', '.gitignore', '.gitkeep', 'gulpfile.js', 'package.json', 'node_modules', 'scss', 'js']
    }))
  ;
});
