<?php

namespace Admin\Controller;

use Zend\Session\Container;
use Zend\View\Model\ViewModel;
use Zend\Validator\AbstractValidator;

class EstoqueController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\EstoqueLog';
	protected $filter 		= 'admin-filter-estoquelog';
	protected $form 		= 'admin-form-estoquelog';
	protected $service		= 'admin-service-estoquelog';

	protected $controller	= 'estoque';
	protected $template		= 'admin/estoque/form.phtml';
	protected $order		= array('s.id' => 'DESC');

	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
		$idProduto = $this->params('id');

		// instanciando os services
		$serviceAuth = 1;

		$dadosEstoque = $this->getEm('Admin\Entity\Estoque')->findByProduto($idProduto);
		$idsEstoque = array();
		if (count($dadosEstoque)) {
			foreach ($dadosEstoque as $estoque) {
				$idsEstoque[] = $estoque->getId();
			}
		}

		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		$filtro['estoque'] = $idsEstoque;
		$this->setFiltro($filtro);

		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$paginator = $this->paginator($list, $page);



		return new ViewModel(array(
			'data' => $paginator,
			'dadosEstoque' => $dadosEstoque,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'idProduto' => $idProduto
		));
	}

	public function cadastrarAction()
	{
		// pegando parâmetros url
		$request = $this->getRequest();
		$idEstoque = $this->params('id');

		// instanciando o form
		$form = $this->getServiceLocator()->get($this->form);

		// tratando os dados do filtro vindos do container
		$container = new Container(str_replace("-", "", $this->controller));

		$url = "";
		$url .= isset($container->filtro['params']['pagina']) ? "pagina=" . $container->filtro['params']['pagina'] : "pagina=1";

		if ($request->isPost())
		{
			if ($this->filter != null)
			{
				$form->setInputFilter($this->getServiceLocator()->get($this->filter));
			}

			AbstractValidator::setDefaultTranslator($this->getServiceLocator()->get('MvcTranslator'));

			$data = $request->getPost()->toArray();
			$data['estoque'] = $idEstoque;

			$form->setData($data);
			if ($form->isValid())
			{
				$service = $this->getServiceLocator()->get($this->service);
				if ($return = $service->insert($data))
				{
					$this->flashMessenger()->addMessage(array('success' => 'Cadastro efetuado com sucesso!'));
				}
				else
				{
					$this->flashMessenger()->addMessage(array('error' => 'Houve um erro ao tentar cadastrar o seu registro!'));
				}

				if ($this->module === null)
					return $this->redirect()->toRoute($this->route, array('controller' => $this->controller, 'id' => $return->getProduto()->getId()));
				else
					return $this->redirect()->toUrl("/" . $this->module . "/" . $this->controller . "/{$return->getProduto()->getId()}" . $url);
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