<?php

namespace Admin\Service;

use Admin\Service\AbstractService;

class Categoria extends AbstractService
{
	public function insert(array $data, $entity)
	{
		$data['slug'] = parent::tituloToSlug($data['nome']);
		
		return parent::insert($data, $entity);
	}
}