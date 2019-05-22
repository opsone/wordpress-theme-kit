php -r "file_put_contents('.env', 'production');"
php ./scripts/version.php;
rm -rf assets/dist;
