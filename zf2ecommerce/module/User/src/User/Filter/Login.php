<?php

namespace User\Filter;

use Zend\Validator\EmailAddress;
use Zend\InputFilter\InputFilter;

class Login extends InputFilter
{
	public function __construct()
	{
		$validatorEmail = new EmailAddress();
		$validatorEmail->setOptions(array('domain' => FALSE));
		
		$this->add(array(
			'name' => 'email',
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			),
			'validators' => array(
				$validatorEmail,
				array(
					'name' => 'NotEmpty',
					'options' => array(
						'messages' => array(
							'isEmpty' => 'Digite corretamente o seu e-mail!'
						)
					)
				)
			)
		));
		
		$this->add(array(
			'name' => 'senha',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
	}
}