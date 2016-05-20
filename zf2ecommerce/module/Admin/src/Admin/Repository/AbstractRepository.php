<?php

namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;

abstract class AbstractRepository extends EntityRepository
{
	public function findFilter(array $filtro, $order = array())
	{
		$where = "1=1 ";
		
		if (count($filtro))
		{
			foreach ($filtro as $id => $val)
			{
				$cast = (int) $val;
				switch ($val) {
					case "IS NULL":
						$where .= "AND s.{$id} {$val} ";
						break;
					case "IS NOT NULL":
						$where .= "AND s.{$id} {$val} ";
						break;
					default:
						if ($cast == 0)
							$where .= "AND s.{$id} LIKE '%{$val}%'";
						if ($cast > 0)
							$where .= "AND s.{$id} = '{$val}'";
						break;
							
				}
			}
		}
		
		$select = $this->createQueryBuilder('s');
		$select->where($where);
		
		if (count($order))
			$select->orderBy(key($order), current($order));
		
		return $select->getQuery()->getResult();
	}
	
	public function findPairs(array $filtro = array())
	{
		$where = "1=1 ";
		
		if (count($filtro))
		{
			foreach ($filtro as $id => $val)
			{
				$cast = (int) $val;
				switch ($val) {
					case "IS NULL":
						$where .= "AND s.{$id} {$val} ";
						break;
					case "IS NOT NULL":
						$where .= "AND s.{$id} {$val} ";
						break;
					default:
						if ($cast == 0)
							$where .= "AND s.{$id} LIKE '%{$val}%'";
						if ($cast > 0)
							$where .= "AND s.{$id} = '{$val}'";
						break;
							
				}
			}
		}
		
		$select = $this->createQueryBuilder('s');
		$select->where($where);
		$result = $select->getQuery()->getResult();
		
		$arrResult = array();
		if (count($result))
		{
			foreach ($result as $item)
			{
				$arrResult[$item->getId()] = $item->getNome();
			}
		}
		
		return $arrResult;
	}
	
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
	
		return $result;
	}
	
	// Função para transformar titulo da notícia em url amigavel, função full
	public function titleToSlug($strValor) {
		$filterString = new String();
		return $filterString->titleToSlug($strValor);
	}
	
	public function getToken()
	{
		$filterString = new String();
		return $filterString->getToken();
	}
}