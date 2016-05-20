<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\Mapping as ORM;

/**
 * CaracteristicaPerfil
 *
 * @ORM\Table(name="caracteristica_perfil")
 * @ORM\Entity(repositoryClass="Admin\Repository\CaracteristicaPerfil")
 */
class CaracteristicaPerfil
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Caracteristica", inversedBy="caracteristicaPerfil")
     * @ORM\JoinTable(name="caracteristica_perfil_caracteristica",
     *   joinColumns={
     *     @ORM\JoinColumn(name="caracteristica_perfil_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="caracteristica_id", referencedColumnName="id")
     *   }
     * )
     */
    private $caracteristica;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->caracteristica = new \Doctrine\Common\Collections\ArrayCollection();

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

    public function getCaracteristica()
    {
        return $this->caracteristica;
    }

    public function setCaracteristica($caracteristica)
    {
        $this->caracteristica = $caracteristica;
    }
}
