<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;

class FreteController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Frete';
	protected $filter 		= 'admin-filter-frete';
	protected $form 		= 'admin-form-frete';
	protected $service		= 'admin-service-frete';
	
	protected $controller	= 'frete';
	protected $template		= 'admin/frete/form.phtml';
	
	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
	
		// instanciando os services
		$serviceAuth = 1;
	
		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		
		// setando os valores default
		$filtro['transporte'] = isset($filtro['transporte']) ? $filtro['transporte'] : "";
		
		$this->setFiltro($filtro);
	
		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
	
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$transportes = $this->getEm('Admin\Entity\Transporte')->findPairs();
		
		$paginator = $this->paginator($list, $page);
	
		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'transportes' => $transportes
		));
	}
	
}