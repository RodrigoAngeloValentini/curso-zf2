<?php

namespace Admin\Repository;

use Core\Filter\String;

class Perfil extends AbstractRepository
{
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
		
		if (isset($result['perfil']))
			$result['perfil'] = $result['perfil']->getId();
		unset($result['children']);
		
		return $result;
	}
	
	public function getRoles() 
	{
		$roles = $this->findAll();
		$filterString = new String();
		$return = array();
		if (count($roles)) {
			foreach ($roles as $role) {
				$roleFilho = $filterString->titleToSlug($role->getNome());
				$rolePai = $role->getPerfil() ? $filterString->titleToSlug($role->getPerfil()->getNome()) : $filterString->titleToSlug($role->getNome());   
				$return[$roleFilho] = $rolePai;
			}
		}
		
		return $return;
	}
}