<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdutoCaracteristica
 *
 * @ORM\Table(name="produto_caracteristica", indexes={@ORM\Index(name="fk_produto_caracteristica_produto1_idx", columns={"produto_id"}), @ORM\Index(name="fk_produto_caracteristica_caracteristica1_idx", columns={"caracteristica_id"})})
 * @ORM\Entity
 */
class ProdutoCaracteristica
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
     * @ORM\Column(name="valor", type="string", length=200, nullable=true)
     */
    private $valor;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;

    /**
     * @var \Caracteristica
     *
     * @ORM\ManyToOne(targetEntity="Caracteristica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="caracteristica_id", referencedColumnName="id")
     * })
     */
    private $caracteristica;

    /**
     * Constructor
     */
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

    public function getValor()
    {
        return $this->valor;
    }

    public function setValor($valor)
    {
        $this->valor = $valor;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;
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
