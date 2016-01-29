<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class Categoria extends InputFilter
{
	public function __construct()
	{
	
	$this->add(array(
		'name'=> 'nome',
		'allow_empty' => false	
	));
	
	}
}