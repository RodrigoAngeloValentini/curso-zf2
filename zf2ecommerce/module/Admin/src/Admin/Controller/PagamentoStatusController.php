<?php

namespace Admin\Controller;

class PagamentoStatusController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\PagamentoStatus';
	protected $filter 		= 'admin-filter-pagamentostatus';
	protected $form 		= 'admin-form-pagamentostatus';
	protected $service		= 'admin-service-pagamentostatus';
	
	protected $controller	= 'pagamentostatus';
	protected $template		= 'admin/pagamento-status/form.phtml';
	protected $order		= array('s.nome' => 'ASC');
	
}