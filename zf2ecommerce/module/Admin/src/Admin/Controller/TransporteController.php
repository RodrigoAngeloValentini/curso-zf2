<?php

namespace Admin\Controller;

class TransporteController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Transporte';
	protected $filter 		= 'admin-filter-transporte';
	protected $form 		= 'admin-form-transporte';
	protected $service		= 'admin-service-transporte';
	
	protected $controller	= 'transporte';
	protected $template		= 'admin/transporte/form.phtml';
	protected $order		= array('s.nome' => 'ASC');
	
}