<?php

namespace Bundle\AdminBundle\Helper;

use Bundle\CoreBundle\Helper\Helper as HelperAction;

class Helper extends HelperAction
{
    /* Video iframe */
    public static function getMoviesType($url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches)) {
            return 'youtube';
        }
        else if (preg_match('#http://www.dailymotion.com/video/([A-Za-z0-9]+)#s', $url, $matches)) {
            return 'dailymotion';
        }
        else if (preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $url, $match))
        {
            $json = @file_get_contents('http://vimeo.com/api/v2/video/'.$match[3].'.json');
            if ($json === false) {
                return null;
            }
            return 'vimeo';
        }

        return null;
    }

    public static function getMoviesId($url)
    {
        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches)) {
            return $matches[1];;
        }
        else if (preg_match('#http://www.dailymotion.com/video/([A-Za-z0-9]+)#s', $url, $matches)) {
            return $matches[1];;
        }
        else if (preg_match('/^http:\/\/(www\.)?vimeo\.com\/(clip\:)?(\d+).*$/', $url, $match))
        {
            $json = @file_get_contents('http://vimeo.com/api/v2/video/'.$match[3].'.json');
            if ($json === false) {
                return null;
            }
            return $match[3];;
        }

        return null;
    }

    public static function getMoviesUrl($url)
    {
        switch (FC_helper::get_movies_type($url)) {
            case('youtube'):        return 'http://www.youtube.com/embed/' . FC_helper::get_movies_id($url);
            break;
            case('dailymotion'):    return 'http://www.dailymotion.com/embed/video/' . FC_helper::get_movies_id($url);
            break;
            case('vimeo'):          return 'http://player.vimeo.com/video/' . FC_helper::get_movies_id($url);
            break;
        }

        return null;
    }

    public static function isMobile()
    {
        if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|sagem|sharp|sie-|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $_SERVER['HTTP_USER_AGENT']))
            return true;
        else
            return false;
    }
}
