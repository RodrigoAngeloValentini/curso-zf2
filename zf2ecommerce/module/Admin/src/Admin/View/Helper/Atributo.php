<?php

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class Atributo extends AbstractHelper implements ServiceLocatorAwareInterface
{
	protected $serviceLocator;

	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;

		return $this;
	}

	public function getServiceLocator()
	{
		return $this->serviceLocator;
	}

	public function __invoke($atributo)
	{
		$helperPluginManager = $this->getServiceLocator();
		$entityManager = $helperPluginManager->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$repositoryAtributo = $entityManager->getRepository('Admin\Entity\Atributo');

		return $repositoryAtributo->getNome($atributo);
	}
}