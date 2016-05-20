<?php

namespace Admin\Service;

class Perfil extends AbstractService
{
	protected $entity = 'Admin\Entity\Perfil'; 
	
	public function insert(array $data, $entity = null)
	{
		// verificando a categoria
		if ($data['perfil'] > 0) {
			$data['perfil'] = $this->getEmRef('Admin\Entity\Perfil', $data['perfil']);
		} else {
			unset($data['perfil']);
		}
		
		parent::insert($data);
	}
	
	public function update(array $data, $id, $entity = null)
	{
		// verificando a categoria
		if ($data['perfil'] > 0) {
			$data['perfil'] = $this->getEmRef('Admin\Entity\Perfil', $data['perfil']);
		} else {
			unset($data['perfil']);
		}
		
		parent::update($data, $id);
	}
}