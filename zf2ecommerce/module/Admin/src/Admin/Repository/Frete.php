<?php

namespace Admin\Repository;

class Frete extends AbstractRepository
{
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
		$result['transporte'] = $result['transporte']->getId();
		
		return $result;
	}
	
}