<?php

namespace User\Controller;

use User\Form\Usuario;

use User\Form\DadosPessoais;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractController
{
	public function indexAction()
	{
		$dadosPessoais = $this->getEm('Admin\Entity\DadosPessoais')->findOneByUsuario($this->getUser()->getId());
		
		return new ViewModel(array(
			'dadosPessoais' => $dadosPessoais
		));
	}
	
	public function dadosPessoaisAction()
	{
		$request = $this->getRequest();
		$form = new DadosPessoais();
		$data = $this->getEm('Admin\Entity\DadosPessoais')->findOneByUsuario($this->getUser()->getId())->toArray();
		$form->setData($data);
		
		if ($request->isPost()) {
			$serviceUsuario = $this->getServiceLocator()->get('user-service-usuario');
			$data = $request->getPost()->toArray();
			$form->setData($data);
			$form->setInputFilter(new \User\Filter\DadosPessoais());
			if ($form->isValid()) {
				if ($serviceUsuario->editarDadosPessoais($data, $this->getUser()->getId())) {
					$this->flashMessenger()->addMessage(array('success' => 'Os dados pessoais foram atualizados com sucesso!'));
					$this->redirect()->toRoute('user');
				}
			}
		}
		
		return new ViewModel(array(
			'form' => $form
		));
	}
	
	public function alterarDadosAction()
	{
		$request = $this->getRequest();
		$form = new Usuario();
		$dataUsuario = $this->getEm('Admin\Entity\Usuario')->find($this->getUser()->getId())->toArray();
		$data = array(
			'usuario_nome' => $dataUsuario['nome'],
			'email' => $dataUsuario['email']
		);
		
		$form->setData($data);
		
		if ($request->isPost()) {
			$serviceUsuario = $this->getServiceLocator()->get('user-service-usuario');
			$data = $request->getPost()->toArray();
			$form->setData($data);
			
			$filter = new \User\Filter\Usuario();
			if ($data['senha'] == "") {
				$filter->get('senha')->setRequired(false);
				$filter->get('confirme_senha')->setRequired(false);
			}
			
			$form->setInputFilter($filter);
			if ($form->isValid()) {
				if ($serviceUsuario->update($data, $this->getUser()->getId())) {
					$this->flashMessenger()->addMessage(array('success' => 'Os dados pessoais foram atualizados com sucesso!'));
					$this->redirect()->toRoute('user');
				}
			}
		}
		
		return new ViewModel(array(
			'form' => $form
		));
	}
}