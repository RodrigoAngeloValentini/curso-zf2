<?php

namespace User;

use Zend\Authentication\AuthenticationService;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        //$moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        //$sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        //$sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController', MvcEvent::EVENT_DISPATCH, array($this, 'mvcPreDispatch'), 100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function mvcPreDispatch($event) 
    {
    	$sm = $event->getTarget()->getServiceLocator();
    	$routeMatch = $event->getRouteMatch();
    	
    	$moduleName = $routeMatch->getParam('module');
    	$controllerName = $routeMatch->getParam('controller');
    	$actionName = $routeMatch->getParam('action');
    	
    	$controllerAction = $controllerName . '.' . $actionName;
    	
    	$config = include __DIR__ . '/config/module.config.php';
    	$authService = $sm->get('user-service-auth');
    	if (!$authService->authorize($moduleName, $controllerName, $actionName) && $controllerAction != "User\Controller\Login.index") {
    		$flashMessenger = $event->getTarget()->flashMessenger();
    		$flashMessenger->addMessage(array('error' => 'Você não tem permissão de acesso a esta área'));
    		$response = $event->getResponse();
    		$response->getHeaders()->addHeaderLine('Location', '/user/login');
    		$response->setStatusCode('302');
    		
    		return $response;
    	}
    	
    	return true;
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'Zend\Authentication\AuthenticationService' => function ($sm) {
    				return $sm->get('doctrine.authenticationservice.orm_default');
    			}
    		)
    	);
    }
}
