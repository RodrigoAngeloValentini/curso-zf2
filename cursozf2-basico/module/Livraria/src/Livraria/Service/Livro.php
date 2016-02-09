<?php

namespace Livraria\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;

class Livro extends AbstractService{

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        $this->entity= "Livraria\Entity\Livro";
    }

    public function insert(array $data){
        $entity = new $this->entity($data);

        $categoria = $this->em->getReference("Livraria\Entity\Categoria", $data['categoria']);

        $entity->setCategoria($categoria);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

    public function update(array $data) {
        $entity = $this->em->getReference($this->entity, $data['id']);
        //$entity = Configurator::configure($entity,$data);
        // hydrator
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $entity);

        $categoria = $this->em->getReference("Livraria\Entity\Categoria", $data['categoria']);
        $entity->setCategoria($categoria);

        $this->em->persist($entity);
        $this->em->flush();

        return $entity;
    }

}