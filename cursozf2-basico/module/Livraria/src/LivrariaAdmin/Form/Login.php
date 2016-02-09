<?php

namespace LivrariaAdmin\Form;

use Zend\Form\Form;

class Login extends Form {
    
    public function __construct($name = null) {
        parent::__construct('user');
        
        $this->setAttribute('method', 'post');
        
        
        
        $this->add(array(
           'name' => 'email',
            'options' => array(
                'type' => 'email',
                'label' => 'Email'
            ),
            'attributes' => array(
                'placeholder' => 'Entre com o email',
                'class' => 'form-control'
            )
        ));
        $this->add(array(
           'name' => 'password',
            'options' => array(
                'type' => 'Password',
                'label' => 'Senha'
            ),
            'attributes' => array(
                'type' => 'password',
                'class' => 'form-control'
            )
        ));
        
        $this->add(array(
           'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Login',
                'class' => 'btn btn-success'
            )
        ));
    }
}
