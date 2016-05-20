<?php

namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Form\Atributo as FormAtributo;

class Atributo implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new FormAtributo($serviceLocator->get('servicemanager'));
	}
}