<?php

namespace User\Form;

use Zend\Form\Element\Password;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Usuario extends Form
{
	public function __construct()
	{
		parent::__construct('form-usuario');		
		
		$nome = new Text('usuario_nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o seu nome'
			));
		$this->add($nome);
		
		$email = new Text('email');
		$email->setLabel('Email')
			->setAttributes(array(
				'id' => 'email',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite o seu email'
			));
		$this->add($email);
		
		$senha = new Password('senha');
		$senha->setLabel('Senha')
			->setAttributes(array(
				'id' => 'senha',
				'class' => 'form-control input-lg',
				'placeholder' => 'Digite a sua senha'
			));
		$this->add($senha);
		
		$reSenha = new Password('confirme_senha');
		$reSenha->setLabel('Senha')
			->setAttributes(array(
				'id' => 'confirme_senha',
				'class' => 'form-control input-lg',
				'placeholder' => 'Confirma a senha digitada',
				'autocomplete' => false
			));
		$this->add($reSenha);
		
	}
}