<?php

namespace User\Filter;

use Zend\InputFilter\InputFilter;

class Endereco extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'logradouro',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'numero',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'bairro',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'cidade',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'estado',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'cep',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
	}
}