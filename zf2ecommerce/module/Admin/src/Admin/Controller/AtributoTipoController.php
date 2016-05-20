<?php

namespace Admin\Controller;

class AtributoTipoController extends AbstractCrudController
{
	protected $entity 		= 'Admin\Entity\AtributoTipo';
	protected $filter 		= 'admin-filter-atributo-tipo';
	protected $form 		= 'admin-form-atributo-tipo';
	protected $service		= 'admin-service-atributo-tipo';

	protected $controller	= 'atributo-tipo';
	protected $template		= 'admin/atributo-tipo/form.phtml';
	protected $order		= array('s.nome' => 'DESC');

}