<?php

namespace Bundle\FrontBundle\Form;

use Bundle\CoreBundle\Form\Form;
use Respect\Validation\Validator as v;

class FormTest extends Form
{
    public function __construct($data) {
        parent::__construct();

        $this->data   = $data;
        $this->fields = array(
          'firstname' => array(
            'value'      => $this->data['firstname'],
            'validators' => array('notEmpty'),
            'errors'     => array('Firstname is empty'),
          ),
          'email' => array(
            'value'      => $this->data['email'],
            'validators' => array('email', 'notEmpty'),
            'errors'     => array('Email is not valid', 'Email is empty'),
          ),
          'url' => array(
            'value'      => $this->data['url'],
            'validators' => array('notEmpty', 'url'),
            'errors'     => array('Url is empty', 'Url is not valid'),
          ),
          'cv' => array(
            'value'      => $_FILES['cv'],
            'validators' => function() {
                return v::exists()->validate($_FILES['cv']["tmp_name"]);
            },
            'errors'     => array('File is empty'),
          ),
          'content' => array(
            'value'      => $this->data['content'],
            'validators' => function($value) {
                return v::when(v::int(), v::positive(), v::notEmpty())->validate($value);
            },
            'errors'     => array('content is not valid'),
          ),
          'int' => array(
            'value'      => $this->data['int'],
            'validators' => function($value) {
                return v::allOf(v::int(), v::positive(), v::notEmpty())->validate($value);
            },
            'errors'     => array('int is not valid'),
          ),
          'uppercase' => array(
            'value'      => '',
            'validators' => function($value) {
                return v::string()->uppercase()->validate($value);
            },
            'errors'     => array('uppercase is not valid'),
          ),
        );
    }
}
