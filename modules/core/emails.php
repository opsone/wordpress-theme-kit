<?php

function setHtmlContentType()
{
    return 'text/html';
}

add_filter('wp_mail_content_type', 'setHtmlContentType');
