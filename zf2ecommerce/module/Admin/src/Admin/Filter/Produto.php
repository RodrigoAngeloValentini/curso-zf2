<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class Produto extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'codigo',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

		$this->add(array(
			'name' => 'nome',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

		$this->add(array(
			'name' => 'descricao',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

		$this->add(array(
			'name' => 'peso',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

		$this->add(array(
			'name' => 'ativo',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));

		$this->add(array(
			'name' => 'categoria',
			'required' => true,
			'filters' => array(
				array('name' => 'StringTrim'),
				array('name' => 'StripTags')
			)
		));
	}
}