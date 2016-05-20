<?php

namespace Admin\Factory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

use Admin\Form\Frete as FormFrete;

class Frete implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		return new FormFrete($serviceLocator->get('servicemanager'));
	}
}