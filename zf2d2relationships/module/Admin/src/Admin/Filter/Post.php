<?php

namespace Admin\Filter;

use Zend\InputFilter\InputFilter;

class Post extends InputFilter
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'categoria',
			'allow_empty' => false
		));
		$this->add(array(
			'name' => 'nome',
			'allow_empty' => false
		));
		$this->add(array(
			'name' => 'conteudo',
			'allow_empty' => false
		));
	}
}