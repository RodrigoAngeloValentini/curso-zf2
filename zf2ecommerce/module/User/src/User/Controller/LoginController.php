<?php

namespace User\Controller;

use User\Filter\Login;

use Zend\View\Model\ViewModel;

use User\Form\Usuario;

use Application\Controller\AbstractController;

class LoginController extends AbstractController
{
	public function indexAction()
	{
		$form = new Usuario();
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			$form->setData($data);
			$form->setInputFilter(new Login());
			if ($form->isValid()) {
				$authService = $this->getServiceLocator()->get('user-service-auth');
				if ($authService->authenticate($data) == 'logado') {
					$this->flashMessenger()->addMessage(array('success' => 'Usuario logado!'));
					return $this->redirect()->toRoute('admin/default');
				}
				
				$this->flashMessenger()->addMessage(array('error' => 'Houve um erro em sua authenticação!'));
				return $this->redirect()->toRoute('user/default', array('controller' => 'login', 'action' => 'index'));
			}
		}
		
		return new ViewModel(array(
			'form' => $form
		));
	}
	
	public function logoutAction()
	{
		$serviceAuth = $this->getServiceLocator()->get('user-service-auth');
		$serviceAuth->logout();
		
		return $this->redirect()->toRoute('home');
	}
}