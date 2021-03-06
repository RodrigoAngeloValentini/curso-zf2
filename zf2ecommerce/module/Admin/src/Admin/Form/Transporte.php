<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Transporte extends Form
{
	public function __construct()
	{
		parent::__construct('form-atributo');
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);
		
		$status = new Select('status');
		$status->setLabel('Status')
			->setAttributes(array(
				'id' => 'status',
				'class' => 'form-control',
				'options' => array(
					'' => 'Selecione o status',
					'1' => 'Ativo',
					'0' => 'Inativo'
				)
			));
		$this->add($status);
	}
}