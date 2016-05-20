<?php

namespace Admin\Service;

class Categoria extends AbstractService
{
	protected $entity = 'Admin\Entity\Categoria'; 
	
	public function insert(array $data, $entity = null)
	{
		$data['slug'] = $this->titleToSlug($data['nome']);
		
		// verificando a categoria
		if ($data['categoria'] > 0) {
			$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		} else {
			unset($data['categoria']);
		}
		
		parent::insert($data);
	}
	
	public function update(array $data, $id, $entity = null)
	{
		//$data['slug'] = $this->titleToSlug($data['nome']);
		
		// verificando a categoria
		if ($data['categoria'] > 0) {
			$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		} else {
			unset($data['categoria']);
		}
		
		parent::update($data, $id);
	}
}