<?php

namespace Admin\Repository;

class Estoque extends AbstractRepository
{
	/**
	 * Retorna o preco atual do produto
	 *
	 * @param int $produto
	 * @return object|null
	 */
	public function getTotalEstoque($produto)
	{
		$qb = $this->createQueryBuilder('estoque');
		$qb
		->select('sum(estoque.qtd)')
		->where($qb->expr()->eq('estoque.produto', ':produto'))
			->setParameter('produto', $produto)
		;

		$result = $qb->getQuery()->getOneOrNullResult();

		return $result;
	}
}