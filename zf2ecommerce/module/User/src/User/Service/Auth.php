<?php

namespace User\Service;

use Zend\Permissions\Acl\getRole;

use Zend\Session\Container;
use Admin\Service\AbstractService;

class Auth extends AbstractService
{
	public function authenticate($params) 
	{
		if (!isset($params['email']) || !isset($params['senha'])) {
			throw new \Exception('Não foram passsados o login ou senha');
		}
		
		$email = $params['email'];
		$senha = $params['senha'];
		
		$authService = $this->authService();
		$adapter = $authService->getAdapter();
		$adapter->setIdentityValue($email);
		$adapter->setCredentialValue($senha);
		
		$authService->setAdapter($adapter);
		$authResult = $authService->authenticate();
		
		if (!$authResult->isValid()) {
			return 'login_invalido';
		}
		
		$identity = $authResult->getIdentity();
		$authService->getStorage()->write($identity);
		
		return "logado";
	}
	
	public function authorize($moduleName, $controllerName, $actionName)
	{
		$role = 'visitante';
		if ($this->hasIdentity()) {
			$role = $this->getRole();
		}
		
		$resource = $controllerName . '.' . $actionName;
		$acl = $this->getServiceLocator()->get('user-service-acl')->build();
		
		if ($acl->isAllowed($role, $resource)) {
			return true;
		}
	}
	
	public function authService() {
		return $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
	}
	
	public function hasIdentity()
	{
		$authService = $this->authService();
		if ($authService->hasIdentity()) {
			return $authService;
		}
	}
	
	public function getRole()
	{
		if ($this->hasIdentity()) {
			return strtolower($this->UserIdentity()->getPerfil()->getNome());
		}
	}
	
	public function UserIdentity()
	{
		$authService = $this->hasIdentity();
		if ($authService) {
			return $authService->getIdentity();
		}
	}
	
	public function logout()
	{
		$serviceAuth = $this->authService();
		
		return $serviceAuth->clearIdentity() ?: false;
	}
}