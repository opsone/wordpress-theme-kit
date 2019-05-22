echo "\n \033[32m ###################### PNG ###################### \033[0m \n"
find './assets/dist' -iname '*.png' -exec pngquant --verbose --ext .png --force 256 --strip {} \;
# find './dist' -iname "*.png" -exec optipng -o5 -strip all {} \;

echo "\n \033[32m ###################### JPG ###################### \033[0m \n"
find './assets/dist' -iname "*.jpeg" -exec jpegoptim -m80 --all-progressive --strip-all {} \;
find './assets/dist' -iname "*.jpg" -exec jpegoptim -m80 --all-progressive --strip-all {} \;

echo "\n \033[32m ###################### SVG ###################### \033[0m"
find './assets/dist' -iname "*.svg" -exec npx svgo --disable removeViewBox {} \;
