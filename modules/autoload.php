<?php
function dirToArray($dir) {

   $result = array();

   $cdir = scandir($dir);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".", "..", ".DS_Store", ".gitkeep", "controllers", "autoload.php")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result = array_merge($result, dirToArray($dir . DIRECTORY_SEPARATOR . $value));
         }
         else
         {
            $result[] = $dir . '/' . $value;
         }
      }
   }
   return $result;
}

$files = dirToArray(get_stylesheet_directory() . '/modules');

foreach ($files as $file) {
  require_once($file);
}
