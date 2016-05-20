<?php

namespace Admin\Repository;

class EstoqueLog extends AbstractRepository
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
						if ($cast == 0) {
							$where .= "AND s.{$id} LIKE '%{$val}%'";
						}
						if ($cast > 0) {
							if (is_array($val)) {
								$ids = implode(',', $val);
								$where .= "AND s.{$id} IN({$ids})";
							} else {
								$where .= "AND s.{$id} = '{$val}'";
							}
						}
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
}