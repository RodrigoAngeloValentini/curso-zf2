<?php

namespace User\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Core\Collection\Form as CollectionForm;

class Endereco extends Form
{
	public function __construct()
	{
		parent::__construct('form-endereco');
		
		$collectionForm = new CollectionForm();
		$arrEstados = array("" => "Selecione o estado");
		$arrEstados += $collectionForm->getEstados();
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control input-lg',
				'placeholder' => 'Ex. Minha casa, Escritório, etc'
			));
		$this->add($nome);
		
		$logradouro = new Text('logradouro');
		$logradouro->setLabel('Endereço')
			->setAttributes(array(
				'id' => 'logradouro',
				'class' => 'form-control input-lg',
				'placeholder' => 'Ex. Rua Itaipava'
			));
		$this->add($logradouro);
		
		$numero = new Text('numero');
		$numero->setLabel('Número')
			->setAttributes(array(
				'id' => 'numero',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o número do endereço'
			));
		$this->add($numero);
		
		$complemento = new Text('complemento');
		$complemento->setLabel('Complemento')
			->setAttributes(array(
				'id' => 'complemento',
				'class' => 'form-control input-lg',
				'placeholder' => 'Informe o complemento caso seja necessário'
			));
		$this->add($complemento);
		
		$bairro = new Text('bairro');
		$bairro->setLabel('Bairro')
			->setAttributes(array(
				'id' => 'bairro',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o nome seu bairro'
			));
		$this->add($bairro);
		
		$cidade = new Text('cidade');
		$cidade->setLabel('Cidade')
			->setAttributes(array(
				'id' => 'cidade',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o nome da sua cidade'
			));
		$this->add($cidade);
		
		$estado = new Select('estado');
		$estado->setLabel('Estado')
			->setAttributes(array(
				'id' => 'estado',
				'class' => 'form-control input-lg',
				'options' => $arrEstados
			));
		$this->add($estado);
		
		$cep = new Text('cep');
		$cep->setLabel('CEP.:')
			->setAttributes(array(
				'id' => 'cep',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o seu CEP.'
			));
		$this->add($cep);		
		
	}
}