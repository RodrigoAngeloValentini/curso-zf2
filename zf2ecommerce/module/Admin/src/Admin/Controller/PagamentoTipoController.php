<?php

namespace Admin\Controller;

class PagamentoTipoController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\PagamentoTipo';
	protected $filter 		= 'admin-filter-pagamentotipo';
	protected $form 		= 'admin-form-pagamentotipo';
	protected $service		= 'admin-service-pagamentotipo';
	
	protected $controller	= 'pagamentotipo';
	protected $template		= 'admin/pagamento-tipo/form.phtml';
	protected $order		= array('s.nome' => 'ASC');
	
}