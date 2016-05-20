<?php

namespace SON\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tasks")
 */
class Task {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $nome;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    private $descricao;
    
    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $status;
    
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $created_at;
    
    /**
     * @ORM\Column(type="datetime")
     * @var DateTime
     */
    private $updated_at;

    
    public function __construct(array $options = array())
    {
        $this->setCreated_at(new \DateTime("now"));
        $this->setUpdated_at(new \DateTime("now"));
        
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        $hydrator->hydrate($options, $this);
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {

        if (!is_numeric($id))
            throw new \InvalidArgumentException('ID aceita apenas números inteiros');
        
        if ($id<=0)
            throw new \InvalidArgumentException('ID aceita apenas números maiores que zero');

        $this->id = $id;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
        return $this;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        
        if (!is_bool($status))
            throw new \InvalidArgumentException('STATUS aceita apenas booleanos');
        
        $this->status = $status;
        return $this;
    }

    public function getCreated_at() {
        return $this->created_at;
    }

    public function setCreated_at($created_at) {
        
        if(!is_object($created_at))
            throw new \InvalidArgumentException('created_at aceita apenas DateTime');
        
        if(get_class($created_at)<>"DateTime")
            throw new \InvalidArgumentException('created_at aceita apenas DateTime');
        
        $this->created_at = $created_at;
        return $this;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function setUpdated_at($updated_at) {
        
        if(!is_object($updated_at))
            throw new \InvalidArgumentException('updated_at aceita apenas DateTime');
        
        if(get_class($updated_at)<>"DateTime")
            throw new \InvalidArgumentException('updated_at aceita apenas DateTime');
        $this->updated_at = $updated_at;
        return $this;
    }
    
    public function toArray()
    {
        $hydrator = new \Zend\Stdlib\Hydrator\ClassMethods();
        return $hydrator->extract($this);
    }

}
