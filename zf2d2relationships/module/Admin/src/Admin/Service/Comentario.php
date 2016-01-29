<?php

namespace Admin\Service;

class Comentario extends AbstractService
{
	public function insert(array $data, $entity)
	{
		$data['dta_inc'] = true;
		
		if (isset($data['comentarioId']) && $data['comentarioId'] > 0)
			$data['comentario'] = $this->getEmRef('Admin\Entity\Comentario', $data['comentarioId']);
		
		$data['post'] = $this->getEmRef('Admin\Entity\Post', $data['postId']);
	
		return parent::insert($data, $entity);
	}
}