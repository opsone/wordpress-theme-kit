<?php

function includeSingleController($template)
{
    if(basename($template) == 'single.php') {
      initController('\Single\SingleController');
    }

    return $template;
}
add_action('template_include', 'includeSingleController');
