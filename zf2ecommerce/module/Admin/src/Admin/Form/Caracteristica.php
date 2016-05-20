<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Caracteristica extends Form
{
	public function __construct()
	{
		parent::__construct('form-caracteristica');

		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);

		$valor = new Text('valor');
		$valor->setLabel('Valor')
			->setAttributes(array(
				'id' => 'valor',
				'class' => 'form-control'
			));
		$this->add($valor);

		$status = new Select('status');
		$status->setLabel('Status')
			->setAttributes(array(
				'id' => 'status',
				'class' => 'form-control',
				'options' => array(
					'' => 'Selecione o Status',
					'0' => 'Inativo',
					'1' => 'Ativo'
				)
			));
		$this->add($status);
	}
}