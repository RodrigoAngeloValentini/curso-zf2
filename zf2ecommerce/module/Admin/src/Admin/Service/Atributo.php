<?php

namespace Admin\Service;

class Atributo extends AbstractService
{
	protected $entity = 'Admin\Entity\Atributo';

	public function insert(array $data, $entity = null)
	{
		// verificando a categoria
		if ($data['atributo_tipo'] > 0) {
			$data['atributo_tipo'] = $this->getEmRef('Admin\Entity\AtributoTipo', $data['atributo_tipo']);
		} else {
			unset($data['atributo_tipo']);
		}

		parent::insert($data);
	}

	public function update(array $data, $id, $entity = null)
	{
		// verificando a categoria
		if ($data['atributo_tipo'] > 0) {
			$data['atributo_tipo'] = $this->getEmRef('Admin\Entity\AtributoTipo', $data['atributo_tipo']);
		} else {
			unset($data['atributo_tipo']);
		}

		parent::update($data, $id);
	}
}