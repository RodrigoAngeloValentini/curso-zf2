<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Submit;

class Categoria extends Form
{
	public function __construct()
	{
		parent::__construct('formCategoria');
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
				->setAttributes(array(
					'id' => 'nome',
					'class' => 'form-control',
					'placeholder' => 'Digite o seu nome'	
				));
		$this->add($nome);
		
		$submit = new Submit("submit");
		$submit->setValue('Salvar');
		$this->add($submit);
	}
}