<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\Mapping as ORM;

/**
 * Atributo
 *
 * @ORM\Table(name="atributo", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_atributo_atributo_tipo1_idx", columns={"atributo_tipo_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Atributo")
 */
class Atributo
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
     * @ORM\Column(name="nome", type="string", length=60, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=45, nullable=true)
     */
    private $codigo;

    /**
     * @var \AtributoTipo
     *
     * @ORM\ManyToOne(targetEntity="AtributoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="atributo_tipo_id", referencedColumnName="id")
     * })
     */
    private $atributoTipo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="PedidoItem", mappedBy="atributoOpcao")
     */
    private $pedidoItem;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Produto", mappedBy="atributo")
     */
    private $produto;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->pedidoItem = new \Doctrine\Common\Collections\ArrayCollection();
        $this->produtoAtributo = new \Doctrine\Common\Collections\ArrayCollection();
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

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getAtributoTipo()
    {
        return $this->atributoTipo;
    }

    public function setAtributoTipo($atributoTipo)
    {
        $this->atributoTipo = $atributoTipo;
    }

    public function getPedidoItem()
    {
        return $this->pedidoItem;
    }

    public function setPedidoItem($pedidoItem)
    {
        $this->pedidoItem = $pedidoItem;
    }

    public function getProdutoAtributo()
    {
        return $this->produtoAtributo;
    }

    public function setProdutoAtributo($produtoAtributo)
    {
        $this->produtoAtributo = $produtoAtributo;
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
