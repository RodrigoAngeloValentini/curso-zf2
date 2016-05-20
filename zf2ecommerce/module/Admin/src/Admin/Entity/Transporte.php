<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transporte
 *
 * @ORM\Table(name="transporte", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Transporte")
 */
class Transporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    public function __construct(array $data)
    {
    	$hydrator = new ClassMethods();
    	$hydrator->hydrate($data, $this);
    }
    
    public function toArray()
    {
    	$hydrator = new ClassMethods();
    	return $hydrator->extract($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
}
