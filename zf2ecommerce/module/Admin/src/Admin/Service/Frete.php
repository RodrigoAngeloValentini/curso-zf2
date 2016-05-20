<?php

namespace Admin\Service;

class Frete extends AbstractService
{
	protected $entity = 'Admin\Entity\Frete'; 
	
	public function insert(array $data, $entity = null)
	{
		$data['transporte'] = $this->getEmRef('Admin\Entity\Transporte', $data['transporte']);
		
		parent::insert($data);
	}
	
	public function update(array $data, $id, $entity = null)
	{
		$data['transporte'] = $this->getEmRef('Admin\Entity\Transporte', $data['transporte']);
		
		parent::update($data, $id);
	}
}