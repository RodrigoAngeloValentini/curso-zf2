<?php

namespace Admin\Service;

class Foto extends AbstractService
{
	protected $entity = 'Admin\Entity\Foto'; 
	
	public function insert(array $data, $entity = null)
	{
		$data['produto'] = $this->getEmRef('Admin\Entity\Produto', $data['produto']);
		
		parent::insert($data);
	}
	
}