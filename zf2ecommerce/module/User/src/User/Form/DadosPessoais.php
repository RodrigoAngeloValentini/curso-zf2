<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;

class DadosPessoais extends Form
{
	public function __construct()
	{
		parent::__construct('form-dadospessoais');
				
		$rg = new Text('rg');
		$rg->setLabel('RG')
			->setAttributes(array(
				'id' => 'eg',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o número do seu RG'
			));
		$this->add($rg);
		
		$cpf = new Text('cpf');
		$cpf->setLabel('CPF')
			->setAttributes(array(
				'id' => 'cpf',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o número do ser CPF'
			));
		$this->add($cpf);
		
		$telefone = new Text('telefone');
		$telefone->setLabel('Telefone')
			->setAttributes(array(
				'id' => 'telefone',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o número do seu telefone'
			));
		$this->add($telefone);
		
		$celular = new Text('celular');
		$celular->setLabel('Celular')
			->setAttributes(array(
				'id' => 'celular',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o número do seu celular'
			));
		$this->add($celular);
		
	}
}