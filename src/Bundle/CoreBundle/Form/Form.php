<?php

namespace Bundle\CoreBundle\Form;

use Respect\Validation\Validator as v;

class Form
{
    protected $errors;
    protected $fields;
    protected $data;

    public function __construct() {
        $this->errors = [];
    }

    public function getErrors($name=null) {
        if($name) return $this->errors[$name];

        return $this->errors;
    }

    public function getValues() {
      $fields = array();
      foreach ($this->fields as $field) {
        $fields[$field['name']] = $field['value'];
      }

      return $fields;
    }

    public function isValid($name=null)
    {
      if($name) return $this->isValidField($name);

      foreach($this->fields as $name => $field) {
        $this->isValidField($name);
      }

      return !count($this->errors);
    }

    public function isValidField($name)
    {
      $field = $this->fields[$name];

      if(is_array($field['validators']))
      {
        foreach($field['validators'] as $key => $validator)
        {
          if(!v::$validator()->validate($this->data[$name])) {
            $this->errors[$name] = $field['errors'][$key];
          }
        }
      }
      else {
        $value = isset($this->data[$name]) ? $this->data[$name] : null;
        if(!$field['validators']($value)) {
          $this->errors[$name] = current($field['errors']);
        }
      }

      return isset($this->errors[$name]) ? !count($this->errors[$name]) : true;
    }
}
