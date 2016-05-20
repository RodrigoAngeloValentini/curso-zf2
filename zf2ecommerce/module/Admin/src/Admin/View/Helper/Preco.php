<?php

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class Preco extends AbstractHelper implements ServiceLocatorAwareInterface
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

	public function __invoke($produto)
	{
		$helperPluginManager = $this->getServiceLocator();
		$entityManager = $helperPluginManager->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		$repositoryPreco = $entityManager->getRepository('Admin\Entity\Preco');

		return $repositoryPreco->getPreco($produto);
	}
}