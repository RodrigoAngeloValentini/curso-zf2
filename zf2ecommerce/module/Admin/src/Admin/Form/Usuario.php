<?php

namespace Admin\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Usuario extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-categoria');
		
		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');
		
		// definindo variáveis
		$arrPerfil = array('' => 'Selecione');
		
		$repoPerfil = $em->getRepository('Admin\Entity\Perfil');
		$arrPerfil += $repoPerfil->findPairs();
		
		$perfil = new Select('perfil');
		$perfil->setLabel('Perfil')
			->setAttributes(array(
				'id' => 'perfil',
				'class' => 'form-control',
				'options' => $arrPerfil
			));
		$this->add($perfil);
		
		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);
		
		$email = new Text('email');
		$email->setLabel('Email')
			->setAttributes(array(
				'id' => 'email',
				'class' => 'form-control'
			));
		$this->add($email);
		
		$senha = new Text('senha');
		$senha->setLabel('Senha')
			->setAttributes(array(
				'id' => 'senha',
				'class' => 'form-control'
			));
		$this->add($senha);
		
		$status = new Select('status');
		$status->setLabel('Status')
			->setAttributes(array(
				'id' => 'status',
				'class' => 'form-control',
				'options' => array(
					'1' => 'Ativo',
					'0' => 'Inativo'
				)
			));
		$this->add($status);
		
		
	}
}