<?php

namespace Admin\Controller;

class ResourceController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Resource';
	protected $filter 		= 'admin-filter-resource';
	protected $form 		= 'admin-form-resource';
	protected $service		= 'admin-service-resource';
	
	protected $controller	= 'resource';
	protected $template		= 'admin/resource/form.phtml';
	protected $order		= array('s.nome' => 'DESC');
	
}