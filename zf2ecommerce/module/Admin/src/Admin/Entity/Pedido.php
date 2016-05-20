<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pedido
 *
 * @ORM\Table(name="pedido", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pedido_usuario1_idx", columns={"usuario_id"}), @ORM\Index(name="fk_pedido_pedido_status1_idx", columns={"pedido_status_id"}), @ORM\Index(name="fk_pedido_frete1_idx", columns={"frete_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Pedido")
 */
class Pedido
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
     * @ORM\Column(name="vlr_total", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrTotal;

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
     * @var float
     *
     * @ORM\Column(name="vlr_frete", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlrFrete;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=true)
     */
    private $obs;

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
     * @var \PedidoStatus
     *
     * @ORM\ManyToOne(targetEntity="PedidoStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_status_id", referencedColumnName="id")
     * })
     */
    private $pedidoStatus;

    /**
     * @var \Frete
     *
     * @ORM\ManyToOne(targetEntity="Frete")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="frete_id", referencedColumnName="id")
     * })
     */
    private $frete;

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

    public function getVlrTotal()
    {
        return $this->vlrTotal;
    }

    public function setVlrTotal($vlrTotal)
    {
        $this->vlrTotal = $vlrTotal;
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

    public function getVlrFrete()
    {
        return $this->vlrFrete;
    }

    public function setVlrFrete($vlrFrete)
    {
        $this->vlrFrete = $vlrFrete;
    }

    public function getObs()
    {
        return $this->obs;
    }

    public function setObs($obs)
    {
        $this->obs = $obs;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    public function getPedidoStatus()
    {
        return $this->pedidoStatus;
    }

    public function setPedidoStatus($pedidoStatus)
    {
        $this->pedidoStatus = $pedidoStatus;
    }

    public function getFrete()
    {
        return $this->frete;
    }

    public function setFrete($frete)
    {
        $this->frete = $frete;
    }
}
