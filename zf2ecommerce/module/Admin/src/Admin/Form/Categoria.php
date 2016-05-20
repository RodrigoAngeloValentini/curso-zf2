<?php

namespace Admin\Form;

use Zend\Form\Element\Text;

use Zend\Form\Element\Select;

use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Form\Form;

class Categoria extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-categoria');
		
		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');
		
		// definindo variáveis
		$arrCategorias = array('0' => 'Categoria Principal');
		
		$entityCategoria = $em->getRepository('Admin\Entity\Categoria');
		$arrCategorias += $entityCategoria->findPairs();
		
		$parent = new Select('categoria');
		$parent->setLabel('Categoria parentesco')
			->setAttributes(array(
				'id' => 'categoria',
				'class' => 'form-control',
				'options' => $arrCategorias
			));
		$this->add($parent);
		
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
					'' => ' -- ',
					'1' => 'Ativo',
					'0' => 'Inativo'
				)
			));
		$this->add($status);
		
		
	}
}