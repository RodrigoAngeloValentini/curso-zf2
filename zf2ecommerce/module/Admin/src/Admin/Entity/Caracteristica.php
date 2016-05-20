<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristica
 *
 * @ORM\Table(name="caracteristica")
 * @ORM\Entity(repositoryClass="Admin\Repository\Caracteristica")
 */
class Caracteristica
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=200, nullable=false)
     */
    private $valor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="CaracteristicaPerfil", mappedBy="caracteristica")
     */
    private $caracteristicaPerfil;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ProdutoCaracteristica", mappedBy="caracteristica")
     */
    private $produto;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->caracteristicaPerfil = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produto = new \Doctrine\Common\Collections\ArrayCollection();

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

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getCaracteristicaPerfil()
    {
        return $this->caracteristicaPerfil;
    }

    public function setCaracteristicaPerfil($caracteristicaPerfil)
    {
        $this->caracteristicaPerfil = $caracteristicaPerfil;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;
    }
}
