<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;

class PagamentoTipo extends Form
{
	public function __construct()
	{
		parent::__construct('form-pagamentotipo');
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);
		
	}
}