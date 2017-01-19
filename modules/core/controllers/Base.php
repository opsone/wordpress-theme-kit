<?php

namespace Controller;

class Base
{
  protected $datas;

  public function init()
  {
    $this->datas = array();
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    if(method_exists($this, $method)) {
      $datas = $this->{$method}();
      if($datas) {
        $this->datas = array_merge($this->datas, $datas);
      }
    }

    return $this->datas;
  }
}
