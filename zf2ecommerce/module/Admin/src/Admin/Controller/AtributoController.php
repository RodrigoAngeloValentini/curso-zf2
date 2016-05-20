<?php

namespace Admin\Controller;

class AtributoController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Atributo';
	protected $filter 		= 'admin-filter-atributo';
	protected $form 		= 'admin-form-atributo';
	protected $service		= 'admin-service-atributo';
	
	protected $controller	= 'atributo';
	protected $template		= 'admin/atributo/form.phtml';
	protected $order		= array('s.nome' => 'DESC');
	
}