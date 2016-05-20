<?php

namespace Admin\Controller;

class CupomController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Cupom';
	protected $filter 		= 'admin-filter-cupom';
	protected $form 		= 'admin-form-cupom';
	protected $service		= 'admin-service-cupom';
	
	protected $controller	= 'cupom';
	protected $template		= 'admin/cupom/form.phtml';
	protected $order		= array('s.id' => 'DESC');
	
}