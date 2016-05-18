
var gulp          = require('gulp'),
    execSync      = require('child_process').execSync,
    rsync         = require('gulp-rsync'),
    excludeGlobal = [
        '.DS_Store',
        '.git',
        '.gitignore',
        '.gitkeep',
        '.gitmodules',
        'gulpfile.js',
        'package.json',
        'node_modules',
        '*.log'
    ],
    excludeCore = [
        '/wp-cli.phar',
        '/.htaccess',
        '/.htaccess.dist',
        '/robots.txt',
        '/robots.txt.dist',
        '/wp-config.php',
        '/wp-content/uploads',
        '/wp-content/blogs.dir',
        '/wp-content/wp-rocket-config',
        '/wp-content/advanced-cache.php',
        '/wp-content/plugins/mailcatcher',
        '/wp-content/themes/**'
    ],
    excludeTheme = [
        'scss',
        'js'
    ],
    staging = {
      'hostname': 'hostname',
      'sshUser': 'username',
      'sshRootDir': '/path/to/root',
      'sshThemeDir': '/subpath/to/theme',
      'ddbRemoteName': 'database_name_remote',
      'ddbRemoteUser': 'database_username',
      'ddbRemotePassword': 'database_password',
      'ddbLocalName': 'database_name_local',
      'remoteURI': 'foo.domain.fr',
      'localURI': 'local.foo.domain.fr'
    },
    prod = {
      'hostname': 'hostname',
      'sshUser': 'username',
      'sshRootDir': '/path/to/root',
      'sshThemeDir': '/subpath/to/theme',
      'ddbRemoteName': 'database_name_remote',
      'ddbRemoteUser': 'database_username',
      'ddbRemotePassword': 'database_password',
      'ddbLocalName': 'database_name_local',
      'remoteURI': 'foo.domain.fr',
      'localURI': 'local.foo.domain.fr'
    },
    execLog = function (error, stdout, stderr) {
      console.log('stdout: ' + stdout);
      console.log('stderr: ' + stderr);
      if (error !== null) {
          console.log('exec error: ' + error);
      }
    };

gulp.task('deploy-staging', [], function(){
  return gulp.src('./')
    .pipe(rsync({
      root: './',
      hostname: staging.hostname,
      username: staging.sshUser,
      destination: staging.sshRootDir+staging.sshThemeDir,
      recursive: true,
      emptyDirectories: true,
      incremental: true,
      progress: true,
      silent:false,
      clean: true,
      exclude: excludeGlobal.concat(excludeTheme)
    }))
  ;
});

gulp.task('deploy-prod', [], function(){
  return gulp.src('./')
    .pipe(rsync({
      root: './',
      hostname: prod.hostname,
      username: prod.sshUser,
      destination: prod.sshRootDir+prod.sshThemeDir,
      recursive: true,
      emptyDirectories: true,
      incremental: true,
      progress: true,
      silent:false,
      clean: true,
      exclude: excludeGlobal.concat(excludeTheme)
    }))
  ;
});

gulp.task('deploy-core-staging', [], function(){
    return gulp.src('./../../../')
      .pipe(rsync({
        root: './../../../',
        hostname: staging.hostname,
        username: staging.sshUser,
        destination: staging.sshRootDir,
        recursive: true,
        emptyDirectories: true,
        incremental: true,
        progress: true,
        clean: true,
        exclude: excludeGlobal.concat(excludeCore)
    }));
});

gulp.task('deploy-core-prod', [], function(){
    return gulp.src('./../../../')
      .pipe(rsync({
        root: './../../../',
        hostname: prod.hostname,
        username: prod.sshUser,
        destination: prod.sshRootDir,
        recursive: true,
        emptyDirectories: true,
        incremental: true,
        progress: true,
        clean: true,
        exclude: excludeGlobal.concat(excludeCore)
      }));
});

gulp.task('pull-core-staging', [], function () {
    execSync('ssh '+staging.sshUser+'@'+staging.hostname+' "mysqldump -u '+staging.ddbRemoteUser+' -p\''+staging.ddbRemotePassword+'#\' '+staging.ddbRemoteName+'" | mysql -u root '+staging.ddbLocalName, execLog);
    execSync('wp search-replace "//'+staging.remoteURI+'" "//'+staging.localURI+'"', execLog);
    execSync('wp cache flush', execLog);
});

gulp.task('pull-core-prod', [], function () {
    execSync('ssh '+prod.sshUser+'@'+prod.hostname+' "mysqldump -u '+prod.ddbRemoteUser+' -p\''+prod.ddbRemotePassword+'#\' '+prod.ddbRemoteName+'" | mysql -u root '+prod.ddbLocalName, execLog);
    execSync('wp search-replace "//'+prod.remoteURI+'" "//'+prod.localURI+'"', execLog);
    execSync('wp cache flush', execLog);
});
