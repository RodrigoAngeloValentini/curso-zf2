<?php

namespace Admin\Repository;

class Preco extends AbstractRepository
{
	/**
	 * Retorna o preco atual do produto
	 *
	 * @param int $produto
	 * @return object|null
	 */
	public function getPreco($produto)
	{
		$qb = $this->createQueryBuilder('preco');

		$data = new \DateTime('now');

		$andX = $qb->expr()->andX();
		$andX->add($qb->expr()->lte('preco.dtaIni', ':data'))
			->add($qb->expr()->gte('preco.dtaFim', ':data'));

		$qb->where($qb->expr()->eq('preco.produto', ':produto'))
			->andWhere($andX)
			->setParameter('produto', $produto)
			->setParameter('data', $data->format('Y-m-d H:i:s'))
		;

		$result = $qb->getQuery()->getOneOrNullResult();
        $precoResultado = array();

        if ($result) {
            $precoResultado['precoAtual'] = $result->getPrincipal();
            if ($result->getPromocional()) {
                $precoResultado['precoNovo'] = $result->getPromocional();
            }
        }

        return $precoResultado;
	}
}