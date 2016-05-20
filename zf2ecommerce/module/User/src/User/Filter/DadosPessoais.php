<?php

namespace User\Filter;

use Zend\InputFilter\InputFilter;

class DadosPessoais extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'rg',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'cpf',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'telefone',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
	}
}