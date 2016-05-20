<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class AtributoTipo extends Form
{
	public function __construct()
	{
		parent::__construct('form-atributo-tipo');

		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);

		$tipoSelecao = new Select('tipo_selecao');
		$tipoSelecao->setLabel('Tipo de seleção')
			->setAttributes(array(
				'id' => 'tipo_selecao',
				'class' => 'form-control',
				'options' => array(
					'' => 'Selecione o tipo de seleção',
					'1' => 'Radio',
					'2' => 'Checkbox',
					'3' => 'Select'
				)
			));
		$this->add($tipoSelecao);
	}
}