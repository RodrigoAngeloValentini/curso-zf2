<?php

namespace Admin\Controller;

use Zend\Validator\AbstractValidator;

use Zend\Session\Container;

use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Usuario';
	protected $filter 		= 'admin-filter-usuario';
	protected $form 		= 'admin-form-usuario';
	protected $service		= 'admin-service-usuario';
	
	protected $controller	= 'usuario';
	protected $template		= 'admin/usuario/form.phtml';
	protected $order		= array('s.nome' => 'DESC');
	
	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
	
		// instanciando os services
		$serviceAuth = 1;
	
		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		
		// setando os valores default
		$filtro['perfil'] = isset($filtro['perfil']) ? $filtro['perfil'] : "";
		$filtro['status'] = isset($filtro['status']) ? $filtro['status'] : "";
		
		$this->setFiltro($filtro);
	
		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
	
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$perfil = $this->getEm('Admin\Entity\Perfil')->findAll();
		
		$paginator = $this->paginator($list, $page);
	
		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'perfil' => $perfil
		));
	}
	
	public function editarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$id = $this->params('id');
	
		// instanciando o form
		$form = $this->getServiceLocator()->get($this->form);
	
		// tratando os dados do filtro vindos do container
		$container = new Container(str_replace("-", "", $this->controller));
	
		$url = "?";
		$url .= isset($container->filtro['params']['pagina']) ? "pagina=" . $container->filtro['params']['pagina'] : "pagina=1";
	
		// get array contendo os dados a ser editado
		$dataEntity = $this->getEm($this->entity)->findToArray($id);
		$form->setData($dataEntity);
	
		if ($request->isPost())
		{
			if ($this->filter != null)
			{
				$filter = $this->getServiceLocator()->get($this->filter);
				$filter->get('senha')->setRequired(false);
				
				$form->setInputFilter($filter);
			}
				
			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));
				
			$data = $request->getPost()->toArray();
			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				if ($service->update($data, $id))
				{
					$this->flashMessenger()->addMessage(array('success' => 'Cadastro editado com sucesso!'));
				}
				else
				{
					$this->flashMessenger()->addMessage(array('error' => 'Houve um erro ao tentar editar o seu registro!'));
				}
	
				if ($this->module === null)
					return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
				else
					return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . $url);
			}
		}
	
		$view = new ViewModel(array(
			'form' => $form,
			'controller' => $this->controller
		));
		$view->setTemplate($this->template);
	
		return $view;
	}
	
}