<?php

namespace Admin\Service;

class EstoqueLog extends AbstractService
{
	protected $entity = 'Admin\Entity\EstoqueLog';

	public function insert(array $data, $entity = null)
	{
		$em = $this->getEm();

		$entity = $entity ?: $this->entity;
		$data['estoque'] = $this->getEmRef('Admin\Entity\Estoque', $data['estoque']);
		$data['dta_inc'] = true;
		$data['dta_upd'] = true;

		$em->getConnection()->beginTransaction();
		try {
			$dataEstoqueLog = parent::insert($data);
			if ($entityEstoque = $dataEstoqueLog->getEstoque()) {
				switch ($dataEstoqueLog->getTipo()) {
					case "1":
					case "4":
						$qtd = $entityEstoque->getQtd() + $dataEstoqueLog->getQtd();
						$entityEstoque->setQtd($qtd);
						$entityEstoque->setDtaUpd(true);
						break;
					case "2":
					case "3":
						$qtd = $entityEstoque->getQtd() - $dataEstoqueLog->getQtd();
						$entityEstoque->setQtd($qtd);
						$entityEstoque->setDtaUpd(true);
						break;
				}

				$em->persist($entityEstoque);
				$em->flush();

				$em->getConnection()->commit();
				return $entityEstoque;
			}
		} catch (\Exception $e) {
			$em->getConnection()->rollback();
			$em->close();
			return false;
		}
	}
}