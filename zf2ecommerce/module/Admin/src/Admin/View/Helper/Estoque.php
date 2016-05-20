<?php

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class Estoque extends AbstractHelper implements ServiceLocatorAwareInterface
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
		$repository = $entityManager->getRepository('Admin\Entity\Estoque');

		$result = $repository->getTotalEstoque($produto);

		$total = 0;
		if (count($result)) {
			$total = $result['1'];
		}

		return $total;
	}
}