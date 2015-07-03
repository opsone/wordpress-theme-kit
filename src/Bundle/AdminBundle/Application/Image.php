<?php

namespace Bundle\AdminBundle\Application;

use Bundle\CoreBundle\Application\Image as ImageAction;

class Image extends ImageAction
{
    public static function customFormat() {
        if ( function_exists('add_theme_support') ) {
                add_theme_support('post-thumbnails');
                // set_post_thumbnail_size( 590, 210, true ); // default Post Thumbnail dimensions
                // add_image_size('custom', 1500, 1000, true);
        }
    }
}
