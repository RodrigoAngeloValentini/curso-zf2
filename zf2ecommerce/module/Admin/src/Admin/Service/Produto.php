<?php

namespace Admin\Service;

use Admin\Entity\ProdutoCaracteristica;

use Admin\Entity\Estoque;

use Zend\Stdlib\Hydrator\ClassMethods;
use Admin\Entity\Produto as EntityProduto;

class Produto extends AbstractService
{
	protected $entity = 'Admin\Entity\Produto';

	public function insert(array $data, $entity = null)
	{
		$entity = $entity ?: $this->entity;
		$em = $this->getEm();

		if (isset($data['atributo'])) {
			$atributoPost = $data['atributo'];
			unset($data['atributo']);
		} else {
			$atributoPost = array();
		}

		// verificando a categoria
		$data['slug'] = $this->titleToSlug($data['nome']);
		$data['usuario'] = $this->getEmRef('Admin\Entity\Usuario', $this->getIdUsuario());
		$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		$data['dta_inc'] = true;
		$data['dta_upd'] = true;

		$entityProduto = new EntityProduto($data);

		if (count($atributoPost)) {
			foreach ($atributoPost as $idAtributo) {
				$entityAtributo = $this->getEm('Admin\Entity\Atributo')->find($idAtributo);
				$entityProduto->getAtributo()->add($entityAtributo);

				$dataEstoque['dta_inc'] = true;
				$dataEstoque['dta_upd'] = true;
				$dataEstoque['qtd'] = "0";
				$dataEstoque['produto'] = $entityProduto;
				$dataEstoque['atributo'] = $entityAtributo;
				$entityProdutoEstoque = new Estoque($dataEstoque);

				$em->persist($entityProdutoEstoque);
			}
		}

		$em->persist($entityProduto);
		$em->flush();

		if (isset($data['caracteristica'])) {
			foreach ($data['caracteristica'] as $idCaracteristica => $valorCaracteristica) {
				$data['produto'] = $entityProduto;
				$data['caracteristica'] = $this->getEmRef('Admin\Entity\Caracteristica', $idCaracteristica);
				$data['valor'] = $valorCaracteristica;
				$produtoCaracteristica = new ProdutoCaracteristica($data);
				$this->getEm()->persist($produtoCaracteristica);
			}

			$this->getEm()->flush();

			unset($data['caracteristica']);
		}

	}

	public function update(array $data, $id, $entity = null)
	{
		$entity = $entity ?: $this->entity;
		$entityProduto = $this->getEm()->getReference($entity, $id);
		if (isset($data['atributo'])) {
			$atributoPost = $data['atributo'];
			unset($data['atributo']);
		} else {
			$atributoPost = array();
		}

		$produtoCaracteristica = $this->getEm('Admin\Entity\ProdutoCaracteristica')->findBy(array('produto' => $id));
		if (count($produtoCaracteristica)) {
			foreach ($produtoCaracteristica as $item) {
				$this->getEm()->remove($item);
			}

			$this->getEm()->flush();
		}

		if (isset($data['caracteristica'])) {
			foreach ($data['caracteristica'] as $idCaracteristica => $valorCaracteristica) {
				$data['produto'] = $this->getEmRef('Admin\Entity\Produto', $id);
				$data['caracteristica'] = $this->getEmRef('Admin\Entity\Caracteristica', $idCaracteristica);
				$data['valor'] = $valorCaracteristica;
				$produtoCaracteristica = new ProdutoCaracteristica($data);
				$this->getEm()->persist($produtoCaracteristica);
			}

			$this->getEm()->flush();

			unset($data['caracteristica']);
		}

		// verificando a categoria
		$data['slug'] = $this->titleToSlug($data['nome']);
		$data['categoria'] = $this->getEmRef('Admin\Entity\Categoria', $data['categoria']);
		$data['dta_upd'] = true;

		$hydrator = new ClassMethods();
		$hydrator->hydrate($data, $entityProduto);

		$dataProduto = $this->getEm($entity)->find($id);
		$atributoDb = array();
		if (count($dataProduto->getAtributo())) {
			foreach ($dataProduto->getAtributo() as $atributo) {
				$atributoDb[$atributo->getId()] = $atributo->getId();
			}
		}

		$addAtributos = array_diff($atributoPost, $atributoDb);
		$delAtributos = array_diff($atributoDb, $atributoPost);
		$delAtributos = count($atributoPost) ? $delAtributos : $atributoDb;

		if (count($addAtributos)) {
			foreach ($addAtributos as $idAtributo) {
				$entityAtributo = $this->getEm('Admin\Entity\Atributo')->find($idAtributo);
				$entityProduto->getAtributo()->add($entityAtributo);
			}
		}

		if (count($delAtributos)) {
			foreach ($delAtributos as $idAtributo) {
				$entityAtributo = $this->getEm('Admin\Entity\Atributo')->find($idAtributo);
				$entityProduto->getAtributo()->removeElement($entityAtributo);
			}
		}

		$em = $this->getEm();
		$em->persist($entityProduto);
		$em->flush();

	}
}