<?php

namespace Admin\Service;

use Core\Filter\String;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractService implements ServiceLocatorAwareInterface
{
	protected $sl;
	protected $em;
	protected $entity;

	public function insert(array $data, $entity = null)
	{
		$entity = $entity ?: $this->entity;
		$entity = new $entity($data);

		$em = $this->getEm();
		$em->persist($entity);
		$em->flush();

		return $entity;
	}

	public function update(array $data, $id, $entity = null)
	{
		$entity = $entity ?: $this->entity;
		$entity = $this->getEm()->getReference($entity, $id);

		$hydrator = new ClassMethods();
		$hydrator->hydrate($data, $entity);

		$em = $this->getEm();
		$em->persist($entity);
		$em->flush();

		return $entity;
	}

	public function delete($id, $entity = null)
	{
		$entity = $entity ?: $this->entity;

		// verificar se o registro existe
		$findEntity = $this->getEm($entity)->find($id);

		if ($findEntity)
		{
			$entity = $this->getEm()->getReference($entity, $id);
			if ($entity)
			{
				$em = $this->getEm();
				$em->remove($entity);
				$em->flush();

				return $id;
			}
		}
	}

	public function getServiceLocator()
	{
		return $this->sl;
	}

	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->sl = $serviceLocator;
		$this->em = $serviceLocator->get('Doctrine\ORM\EntityManager');

		return $this;
	}

	public function getEm($entity = null)
	{
		if ($entity !== null)
		{
			return $this->em->getRepository($entity);
		}

		return $this->em;
	}

	public function getEmRef($entity, $id)
	{
		return $this->em->getReference($entity, $id);
	}

	// Função para transformar titulo da notícia em url amigavel, função full
	public function titleToSlug($strValor) {
		$filterString = new String();
		return $filterString->titleToSlug($strValor);
	}

	public function getToken()
	{
		$filterString = new String();
		return $filterString->getToken();
	}

	public function getIdUsuario()
	{
		return 1;
	}
}