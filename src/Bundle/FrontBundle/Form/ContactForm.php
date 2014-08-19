<?php

namespace Bundle\FrontBundle\Form;

use WpThemeKitLib\Form\Form;

use Bundle\FrontBundle\Form\Filter\ContactFilter;

use Zend\Captcha;
use Zend\Form\Element;

class ContactForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('contact');

        $name = new Element('name');
        $name->setLabel('Your name');
        $name->setAttributes(array(
            'type'  => 'text',
        ));

        $email = new Element\Email('email');
        $email->setLabel('Your email address');

        $subject = new Element('subject');
        $subject->setLabel('Subject');
        $subject->setAttributes(array(
            'type'  => 'text'
        ));

        $message = new Element\Textarea('message');
        $message->setLabel('Message');

        $captcha = new Element\Captcha('captcha');
        $captcha->setCaptcha(new Captcha\Dumb());
        $captcha->setLabel('Please verify you are human');

        $csrf = new Element\Csrf('security');

        $submit = new Element('submit');
        $submit->setValue('Submit');
        $submit->setAttributes(array(
            'type'  => 'submit'
        ));

        $this->add($name);
        $this->add($email);
        $this->add($subject);
        $this->add($message);
        $this->add($captcha);
        $this->add($csrf);
        $this->add($submit);

        $this->setInputFilter(new ContactFilter());
    }
}
