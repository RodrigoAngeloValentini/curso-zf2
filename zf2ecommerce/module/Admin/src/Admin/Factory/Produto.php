<?php

namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Form\Produto as FormProduto;

class Produto implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new FormProduto($serviceLocator->get('servicemanager'));
	}
}