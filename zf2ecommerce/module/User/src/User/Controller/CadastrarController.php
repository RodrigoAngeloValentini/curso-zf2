<?php

namespace User\Controller;

use User\Form\DadosPessoais;

use User\Form\Usuario;
use User\Filter\Usuario as FilterUsuario;

use User\Form\Endereco;
use User\Filter\Endereco as FilterEndereco;
use User\Filter\DadosPessoais as FilterDadosPessoais;

use Application\Controller\AbstractController;
use Zend\View\Model\ViewModel;

class CadastrarController extends AbstractController
{
	public function indexAction()
	{
		$formEndereco = new Endereco();
		$formUsuario = new Usuario();
		$formDadosPessoais = new DadosPessoais();
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$data = $request->getPost()->toArray();
			
			$formEndereco->setData($data);
			$formEndereco->setInputFilter(new FilterEndereco());
			$formUsuario->setData($data);
			$formUsuario->setInputFilter(new FilterUsuario());
			$formDadosPessoais->setData($data);
			$formDadosPessoais->setInputFilter(new FilterDadosPessoais());
			
			$valid = $formUsuario->isValid();
			$valid ? $valid = $formEndereco->isValid() : $formEndereco->isValid();
			$valid ? $valid = $formDadosPessoais->isValid() : $formDadosPessoais->isValid();
			
			if ($valid) {
				$service = $this->getServiceLocator()->get('user-service-usuario');
				if ($service->insert($data)) {
					$this->flashMessenger()->addMessage(array('success' => 'Cadastro efetuado com sucesso!'));
					return $this->redirect()->toRoute('home');
				}
			}
		}
		
		return new ViewModel(array(
			'formEndereco' => $formEndereco,
			'formUsuario' => $formUsuario,
			'formDadosPessoais' => $formDadosPessoais
		));
	}
}