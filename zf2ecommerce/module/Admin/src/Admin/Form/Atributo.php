<?php

namespace Admin\Form;

use Zend\Form\Form;
use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorInterface;

class Atributo extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-atributo');

		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');

		// definindo variáveis
		$arrAtributoTipo = array('0' => 'Atributo Tipo');

		$repositoryAtributoTipo = $em->getRepository('Admin\Entity\AtributoTipo');
		$arrAtributoTipo += $repositoryAtributoTipo->findPairs();

		$nome = new Text('nome');
		$nome->setLabel('Nome')
			->setAttributes(array(
				'id' => 'nome',
				'class' => 'form-control'
			));
		$this->add($nome);

		$codigo = new Text('codigo');
		$codigo->setLabel('Código')
			->setAttributes(array(
				'id' => 'codigo',
				'class' => 'form-control'
			));
		$this->add($codigo);

		$atributoTipo = new Select('atributo_tipo');
		$atributoTipo->setLabel('Atributo Tipo')
			->setAttributes(array(
				'id' => 'atributo_tipo',
				'class' => 'form-control',
				'options' => $arrAtributoTipo
			));
		$this->add($atributoTipo);
	}
}