<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;

class PedidoController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Pedido';
	protected $service		= 'admin-service-pedido';
	
	protected $controller	= 'pedido';
	protected $order		= array('s.id' => 'DESC');
	
	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
	
		// instanciando os services
		$serviceAuth = 1;
	
		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		
		// setando os valores default
		$filtro['pedido_status'] = isset($filtro['pedido_status']) ? $filtro['pedido_status'] : "";
		
		$this->setFiltro($filtro);
	
		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
	
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$listaPedidoStatus = $this->getEm('Admin\Entity\PedidoStatus')->findPairs();
		
		$paginator = $this->paginator($list, $page);
	
		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'listaPedidoStatus' => $listaPedidoStatus
		));
	}
	
}