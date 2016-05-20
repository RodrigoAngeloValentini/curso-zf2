<?php

namespace SON\Service;

use Doctrine\ORM\EntityManager;

class Task {

    private $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getEm()
    {
        return $this->em;
    }
    
    public function insert(array $data)
    {   
        $entity = new \SON\Entity\Task($data);
        
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
        
        return $entity;
    }
    
    public function update(array $data)
    {
        if(!isset($data['id']))
            throw new \InvalidArgumentException("A key ID é obrigatória dentro do array");
        
        $entity = $this->getEm()->getReference('\SON\Entity\Task', $data['id']);
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->hydrate($data, $entity);
        
        $this->getEm()->persist($entity);
        $this->getEm()->flush();
        
        return $entity;
        
    }
    
    public function delete($id)
    {
        if(!is_integer($id))
            throw new \InvalidArgumentException("O campo ID deve ser numérico");
        
        $entity = $this->getEm()->getReference('\SON\Entity\Task', $id);
        
        $this->getEm()->remove($entity);
        $this->getEm()->flush();
        
        return $id;

    }
}
