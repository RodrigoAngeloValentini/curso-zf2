<?php

namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;

class AbstractRepository extends EntityRepository
{
	public function fetchPairs()
	{
		// definindo o array de resultado
		$arrResult = array();
		
		// buscando os dados com o findAll
		$result = $this->findAll();
		
		// se existir algum registro
		if ($result)
		{
			foreach ($result as $item)
			{
				$arrResult[$item->getId()] = $item->getNome();
			}
		}
		
		return $arrResult;
	}
}