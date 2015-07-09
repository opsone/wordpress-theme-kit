<?php

namespace Bundle\FrontBundle\Controller;

use Bundle\CoreBundle\Controller\Controller;
use Bundle\FrontBundle\Form\FormTest;

class IndexController extends Controller
{
    protected function get(){
      return array();
    }

    protected function post(){

        $form = new FormTest($_POST);

        // if(!$form->isValid('firstname')) {
        //   var_dump($form->getErrors('firstname'));exit;
        // }

        if(!$form->isValid()) {
          var_dump($form->getErrors());exit;
        }

        return array();
    }
}
