<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagamento
 *
 * @ORM\Table(name="pagamento", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pagamento_pedido1_idx", columns={"pedido_id"}), @ORM\Index(name="fk_pagamento_pagamento_status1_idx", columns={"pagamento_status_id"}), @ORM\Index(name="fk_pagamento_pagamento_tipo1_idx", columns={"pagamento_tipo_id"})})
 * @ORM\Entity
 */
class Pagamento
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
     * @ORM\Column(name="vlr_pago", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrPago;

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
     * @var \Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_id", referencedColumnName="id")
     * })
     */
    private $pedido;

    /**
     * @var \PagamentoStatus
     *
     * @ORM\ManyToOne(targetEntity="PagamentoStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pagamento_status_id", referencedColumnName="id")
     * })
     */
    private $pagamentoStatus;

    /**
     * @var \PagamentoTipo
     *
     * @ORM\ManyToOne(targetEntity="PagamentoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pagamento_tipo_id", referencedColumnName="id")
     * })
     */
    private $pagamentoTipo;

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

    public function getVlrPago()
    {
        return $this->vlrPago;
    }

    public function setVlrPago($vlrPago)
    {
        $this->vlrPago = $vlrPago;
    }

    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    public function setDtaInc($dtaInc)
    {
        $this->dtaInc = $dtaInc;
    }

    public function getDtaUpd()
    {
        return $this->dtaUpd;
    }

    public function setDtaUpd($dtaUpd)
    {
        $this->dtaUpd = $dtaUpd;
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    }

    public function getPagamentoStatus()
    {
        return $this->pagamentoStatus;
    }

    public function setPagamentoStatus($pagamentoStatus)
    {
        $this->pagamentoStatus = $pagamentoStatus;
    }

    public function getPagamentoTipo()
    {
        return $this->pagamentoTipo;
    }

    public function setPagamentoTipo($pagamentoTipo)
    {
        $this->pagamentoTipo = $pagamentoTipo;
    }
}
