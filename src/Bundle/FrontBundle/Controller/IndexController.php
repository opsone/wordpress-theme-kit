<?php

namespace Bundle\FrontBundle\Controller;

use WpThemeKitLib\Controller\Controller;
use Bundle\FrontBundle\Form\ContactForm;

class IndexController extends Controller
{
    protected function get(){
        $form = new ContactForm();

        return array('form' => $form);
    }

    protected function post(){
        $form = new ContactForm();
        $form->setData($_POST);

        if($form->isValid()) {
            $data = $form->getData();
            // sample : save email address in option_theme
            wp_mail('jeremy@opsone.net', $data['subject'], $data['message'], "From: {$data['name']} <{$data['email']}>\r\n");
        }

        return array('form' => $form);
    }
}
