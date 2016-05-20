<?php

namespace Admin\Service;

class CaracteristicaPerfil extends AbstractService
{
	protected $entity = 'Admin\Entity\CaracteristicaPerfil';

	public function insert(array $data, $entity = null)
	{
		$caracteristicas = array();

		if (count($data['caracteristica'])) {
			foreach ($data['caracteristica'] as $caracteristica) {
				$caracteristicas[] = $this->getEmRef('Admin\Entity\Caracteristica', $caracteristica);
			}

			$data['caracteristica'] = $caracteristicas;
		} else {
			unset($data['caracteristica']);
		}

		parent::insert($data);
	}

	public function update(array $data, $id, $entity = null)
	{
		$caracteristicas = array();

		if (count($data['caracteristica'])) {
			foreach ($data['caracteristica'] as $caracteristica) {
				$caracteristicas[] = $this->getEmRef('Admin\Entity\Caracteristica', $caracteristica);
			}

			$data['caracteristica'] = $caracteristicas;
		} else {
			unset($data['caracteristica']);
		}

		parent::update($data, $id);
	}
}