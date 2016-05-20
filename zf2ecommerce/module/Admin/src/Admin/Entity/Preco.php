<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Preco
 *
 * @ORM\Table(name="preco", indexes={@ORM\Index(name="fk_preco_produto1_idx", columns={"produto_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Preco")
 */
class Preco
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
     * @var float
     *
     * @ORM\Column(name="principal", type="float", precision=9, scale=2, nullable=false)
     */
    private $principal;

    /**
     * @var float
     *
     * @ORM\Column(name="promocional", type="float", precision=9, scale=2, nullable=true)
     */
    private $promocional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_ini", type="datetime", nullable=false)
     */
    private $dtaIni;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dta_fim", type="datetime", nullable=false)
     */
    private $dtaFim;

    /**
     * @var \Produto
     *
     * @ORM\ManyToOne(targetEntity="Produto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="produto_id", referencedColumnName="id")
     * })
     */
    private $produto;



    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getPrincipal()
    {
        return $this->principal;
    }

    public function setPrincipal($principal)
    {
        $this->principal = $principal;
    }

    public function getPromocional()
    {
        return $this->promocional;
    }

    public function setPromocional($promocional)
    {
        $this->promocional = $promocional;
    }

    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    public function setDtaInc($dtaInc)
    {
        $this->dtaInc = $dtaInc;
    }

    public function getDtaIni()
    {
        return $this->dtaIni;
    }

    public function setDtaIni($dtaIni)
    {
        $this->dtaIni = $dtaIni;
    }

    public function getDtaFim()
    {
        return $this->dtaFim;
    }

    public function setDtaFim($dtaFim)
    {
        $this->dtaFim = $dtaFim;
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
