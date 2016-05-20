<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estoque
 *
 * @ORM\Table(name="estoque", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_estoque_produto1_idx", columns={"produto_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Estoque")
 */
class Estoque
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
     * @var \DateTime
     *
     * @ORM\Column(name="dta_upd", type="datetime", nullable=false)
     */
    private $dtaUpd;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="qtd", type="integer", nullable=false)
     */
    private $qtd;

    /**
     * @var \Produto
     *
     * @ORM\OneToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;

    /**
     * @var \Atributo
     *
     * @ORM\ManyToOne(targetEntity="Atributo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="atributo_id", referencedColumnName="id")
     * })
     */
    private $atributo;

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

    public function getDtaUpd()
    {
        return $this->dtaUpd;
    }

    public function setDtaUpd($dtaUpd)
    {
        $this->dtaUpd = new \DateTime('now');
    }

    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    public function setDtaInc($dtaInc)
    {
        $this->dtaInc = new \DateTime('now');
    }

    public function getQtd()
    {
        return $this->qtd;
    }

    public function setQtd($qtd)
    {
        $this->qtd = $qtd;
    }

    public function getProduto()
    {
        return $this->produto;
    }

    public function setProduto($produto)
    {
        $this->produto = $produto;
    }


    public function getAtributo()
    {
        return $this->atributo;
    }

    public function setAtributo($atributo)
    {
        $this->atributo = $atributo;
    }
}
