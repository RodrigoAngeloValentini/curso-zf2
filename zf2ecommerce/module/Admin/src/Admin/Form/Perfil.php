<?php

namespace Admin\Form;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;

class Perfil extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-perfil');
		
		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');
		
		// definindo variáveis
		$arrPerfil = array('0' => 'Perfil Principal');
		
		$repoPerfil = $em->getRepository('Admin\Entity\Perfil');
		$arrPerfil += $repoPerfil->findPairs();
		
		$perfil = new Select('perfil');
		$perfil->setLabel('Perfil parentesco')
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
		
	}
}