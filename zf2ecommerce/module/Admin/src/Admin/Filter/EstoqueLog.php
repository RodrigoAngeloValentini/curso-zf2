<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class EstoqueLog extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'qtd',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
		$this->add(array(
			'name' => 'tipo',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
		
	}
}