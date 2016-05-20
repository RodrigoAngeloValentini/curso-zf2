<?php

namespace Admin\Controller;

class CaracteristicaController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\Caracteristica';
	protected $filter 		= 'admin-filter-caracteristica';
	protected $form 		= 'admin-form-caracteristica';
	protected $service		= 'admin-service-caracteristica';

	protected $controller	= 'caracteristica';
	protected $template		= 'admin/caracteristica/form.phtml';
	protected $order		= array('s.nome' => 'DESC');

}