<?php

namespace Admin\Repository;

class Categoria extends AbstractRepository
{
	public function findToArray($id)
	{
		$result = $this->find($id)->toArray();
		$result['categoria'] = $result['categoria']->getId();
		unset($result['children']);
		
		return $result;
	}
	
	public function getCategorias()
	{
		$result = $this->findAll();
		$return = array();
		if (count($result)) {
			foreach ($result as $item1) {
				if (!$item1->getCategoria()) {
					$return[$item1->getId()] = $item1->getNome();
				}
				if (count($item1->getChildren())) {
					foreach ($item1->getChildren() as $item2) {
						$return[$item2->getId()] = $item1->getNome() . " -> " . $item2->getNome();
					}
				}
			}
		}
	
		return $return;
	}
}