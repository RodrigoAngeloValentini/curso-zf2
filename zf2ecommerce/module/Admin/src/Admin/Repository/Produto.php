<?php

namespace Admin\Repository;

class Produto extends AbstractRepository
{
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
		$result['categoria'] = $result['categoria']->getId();

		return $result;
	}

	/**
	 * Retorna os produtos com preço ativo
	 *
	 * @param int $categoria
	 * @return object|null
	 */
	public function getProdutos($categoria = null)
	{
		$qb = $this->createQueryBuilder('produto');
		$qb->join('produto.preco', 'preco');

		$data = new \DateTime('now');

		$andX = $qb->expr()->andX();
		$andX->add($qb->expr()->lte('preco.dtaIni', ':data'))
		->add($qb->expr()->gte('preco.dtaFim', ':data'));

		if (!is_null($categoria)) {
			$qb->where($qb->expr()->eq('produto.categoria', ':categoria'))
			->setParameter('categoria', $categoria);
		}

		$qb->andWhere($andX)->setParameter('data', $data->format('Y-m-d H:i:s'));

		$result = $qb->getQuery()->getResult();

		return $result;
	}

    public function getPreco($produto)
    {

    }
}