<?php

namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Form\AtributoTipo as FormAtributoTipo;

class AtributoTipo implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new FormAtributoTipo($serviceLocator->get('servicemanager'));
	}
}