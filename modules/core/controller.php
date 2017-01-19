<?php

function initController($controller_name)
{
  $controller = new $controller_name();
  $vars = $controller->init();

  foreach ($vars as $key => $value) {
    $GLOBALS[$key] = $value;
  }
}

function loadController($template)
{
  $template_name   = ucfirst(str_replace('.php', '', basename($template)));
  $template_name   = ucwords(str_replace('-', ' ', $template_name));
  $template_name   = str_replace(' ', '', $template_name);
  $controller_name = 'Controller\\'.$template_name.'Controller';

  if(class_exists($controller_name)) {
    initController($controller_name);
  }

  return $template;
}

add_action('template_include', 'loadController');
