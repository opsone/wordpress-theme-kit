echo "\n \033[32m ###################### PNG ###################### \033[0m \n"
find './assets/build' -iname '*.png' -exec pngquant --verbose --ext .png --force 256 --strip {} \;
# find './build' -iname "*.png" -exec optipng -o5 -strip all {} \;

echo "\n \033[32m ###################### JPG ###################### \033[0m \n"
find './assets/build' -iname "*.jpeg" -exec jpegoptim -m80 --all-progressive --strip-all {} \;
find './assets/build' -iname "*.jpg" -exec jpegoptim -m80 --all-progressive --strip-all {} \;

echo "\n \033[32m ###################### SVG ###################### \033[0m"
find './assets/build' -iname "*.svg" -exec npx svgo --disable removeViewBox {} \;
