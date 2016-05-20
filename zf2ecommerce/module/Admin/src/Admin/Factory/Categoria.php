<?php

namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Form\Categoria as FormCategoria;

class Categoria implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new FormCategoria($serviceLocator->get('servicemanager'));
	}
}