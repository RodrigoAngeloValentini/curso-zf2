<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class Frete extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'transporte',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'faixa_cep_de',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'faixa_cep_ate',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'vlr',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
	}
}