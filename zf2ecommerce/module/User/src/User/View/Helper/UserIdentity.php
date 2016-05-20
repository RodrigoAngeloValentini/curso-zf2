<?php

namespace User\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\View\Helper\AbstractHelper;

class UserIdentity extends AbstractHelper implements ServiceLocatorAwareInterface 
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
	
	public function __invoke() 
	{
		$helperPluginManager = $this->getServiceLocator();
		$serviceAuth = $helperPluginManager->getServiceLocator()->get('user-service-auth');
		if ($serviceAuth->hasIdentity()) {
			return $serviceAuth->UserIdentity();
		}
	}
}