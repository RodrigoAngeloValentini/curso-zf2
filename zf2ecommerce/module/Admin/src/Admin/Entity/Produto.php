<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\ORM\Mapping as ORM;

/**
 * Produto
 *
 * @ORM\Table(name="produto", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_produto_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fk_produto_categoria1_idx", columns={"categoria_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Produto")
 */
class Produto
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
     * @ORM\Column(name="codigo", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=200, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=200, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="text", nullable=false)
     */
    private $descricao;

    /**
     * @var float
     *
     * @ORM\Column(name="peso", type="float", precision=9, scale=2, nullable=false)
     */
    private $peso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ativo", type="boolean", nullable=false)
     */
    private $ativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_upd", type="datetime", nullable=false)
     */
    private $dtaUpd;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * })
     */
    private $categoria;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Atributo", inversedBy="produto")
     * @ORM\JoinTable(name="produto_atributo",
     *   joinColumns={
     *     @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="atributo_id", referencedColumnName="id")
     *   }
     * )
     */
    private $atributo;

    /**
     * @var \Categoria
     *
     * @ORM\OneToOne(targetEntity="Estoque", mappedBy="produto")
     */
    private $estoque;

    /**
     * @ORM\OneToMany(targetEntity="Foto", mappedBy="produto")
     */
    private $foto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ProdutoCaracteristica", mappedBy="produto")
     */
    private $caracteristica;

    /**
     * @ORM\OneToMany(targetEntity="Preco", mappedBy="produto")
     */
    private $preco;

    /**
     * Constructor
     */
    public function __construct(array $data)
    {
        $this->atributo = new \Doctrine\Common\Collections\ArrayCollection();
        $this->foto = new \Doctrine\Common\Collections\ArrayCollection();

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

    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getPeso()
    {
        return \number_format($this->peso, '3', ',', '');
    }

    public function setPeso($peso)
    {
        $this->peso = str_replace(',', '.', $peso);
    }

    public function getAtivo()
    {
        return $this->ativo;
    }

    public function setAtivo($ativo)
    {
        $this->ativo = $ativo;
    }

    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    public function setDtaInc()
    {
        $this->dtaInc = new \DateTime('now');
    }

    public function getDtaUpd()
    {
        return $this->dtaUpd;
    }

    public function setDtaUpd()
    {
        $this->dtaUpd = new \DateTime('now');
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getAtributo()
    {
        return $this->atributo;
    }

    public function setAtributo($atributo)
    {
        $this->atributo = $atributo;
    }

    public function getEstoque()
    {
        return $this->estoque;
    }

    public function setEstoque($estoque)
    {
        $this->estoque = $estoque;
    }

    public function getFoto()
    {
        return $this->foto;
    }


    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getCaracteristica()
    {
        return $this->caracteristica;
    }
}
