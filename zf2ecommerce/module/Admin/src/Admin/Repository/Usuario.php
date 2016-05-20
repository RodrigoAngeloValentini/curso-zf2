<?php

namespace Admin\Repository;

class Usuario extends AbstractRepository
{
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
		$result['perfil'] = $result['perfil']->getId();
		
		return $result;
	}
}