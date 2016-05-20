<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class EstoqueLog extends Form
{
	public function __construct()
	{
		parent::__construct('form-estoque');
		
		$qtd = new Text('qtd');
		$qtd->setLabel('Quatidade')
			->setAttributes(array(
				'id' => 'qtd',
				'class' => 'form-control'
			));
		$this->add($qtd);
		
		$tipo = new Select('tipo');
		$tipo->setLabel('Tipo')
			->setAttributes(array(
				'id' => 'tipo',
				'class' => 'form-control',
				'options' => array(
					'' => 'Selecione o tipo',
					'1' => 'Entrada',
					'2' => 'Saída',
					'3' => 'Estorno entrada',
					'4' => 'Estorno saída'
				)
			));
		$this->add($tipo);
	}
}