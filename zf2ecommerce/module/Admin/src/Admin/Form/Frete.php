<?php

namespace Admin\Form;

use Zend\Form\Element\Text;
use Zend\Form\Element\Select;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Form\Form;

class Frete extends Form
{
	public function __construct(ServiceLocatorInterface $sl)
	{
		parent::__construct('form-frete');
		
		// instanciando o entity manager do doctrine
		$em = $sl->get('Doctrine\ORM\EntityManager');
		
		// definindo variáveis
		$arrTransportes = array('0' => 'Selecione o transporte');
		
		$entityTransporte = $em->getRepository('Admin\Entity\Transporte');
		$arrTransportes += $entityTransporte->findPairs();
		
		$transporte = new Select('transporte');
		$transporte->setLabel('Transporte parentesco')
			->setAttributes(array(
				'id' => 'transporte',
				'class' => 'form-control',
				'options' => $arrTransportes
			));
		$this->add($transporte);
		
		$faixaCepDe = new Text('faixa_cep_de');
		$faixaCepDe->setLabel('Faixa cep de')
			->setAttributes(array(
				'id' => 'faixa_cep_de',
				'class' => 'form-control'
			));
		$this->add($faixaCepDe);
		
		$faixaCepPara = new Text('faixa_cep_ate');
		$faixaCepPara->setLabel('Faixa cep até')
			->setAttributes(array(
				'id' => 'faixa_cep_ate',
				'class' => 'form-control'
			));
		$this->add($faixaCepPara);
		
		$vlr = new Text('vlr');
		$vlr->setLabel('Valor')
			->setAttributes(array(
				'id' => 'vlr',
				'class' => 'form-control'
			));
		$this->add($vlr);
		
	}
}