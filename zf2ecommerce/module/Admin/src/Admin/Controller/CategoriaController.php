<?php

namespace Admin\Controller;

use Zend\View\Model\ViewModel;

class CategoriaController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Categoria';
	protected $filter 		= 'admin-filter-categoria';
	protected $form 		= 'admin-form-categoria';
	protected $service		= 'admin-service-categoria';
	
	protected $controller	= 'categoria';
	protected $template		= 'admin/categoria/form.phtml';
	protected $order		= array('s.nome' => 'DESC');
	
	public function indexAction()
	{
		$this->getServiceLocator()->get('jv_flashmessenger');
	
		// instanciando os services
		$serviceAuth = 1;
	
		// definindo as variáveis
		$filtro = $this->params()->fromQuery();
		
		// setando os valores default
		$filtro['categoria'] = isset($filtro['categoria']) ? $filtro['categoria'] : "";
		$filtro['status'] = isset($filtro['status']) ? $filtro['status'] : "";
		
		$this->setFiltro($filtro);
	
		$page = isset($filtro['pagina']) ? $filtro['pagina'] : 1;
		$where = $this->getWhere(array('pagina'));
	
		$list = $this->getEm($this->entity)->findFilter($where, $this->order);
		$categoriasParent = $this->getEm($this->entity)->findFilter(array('categoria' => "IS NULL"));
		
		$paginator = $this->paginator($list, $page);
	
		return new ViewModel(array(
			'data' => $paginator,
			'pagina' => $page,
			'filtro' => $filtro,
			'controller' => $this->controller,
			'categorias' => $categoriasParent
		));
	}
	
}