<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * PedidoLog
 *
 * @ORM\Table(name="pedido_log", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_pedido_log_pedido1_idx", columns={"pedido_id"}), @ORM\Index(name="fk_pedido_log_pedido_status1_idx", columns={"pedido_status_id"})})
 * @ORM\Entity
 */
class PedidoLog
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
     * @ORM\Column(name="dta_inc", type="datetime", nullable=false)
     */
    private $dtaInc;

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
     * @var \PedidoStatus
     *
     * @ORM\ManyToOne(targetEntity="PedidoStatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pedido_status_id", referencedColumnName="id")
     * })
     */
    private $pedidoStatus;

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

    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    public function setDtaInc($dtaInc)
    {
        $this->dtaInc = $dtaInc;
    }

    public function getPedido()
    {
        return $this->pedido;
    }

    public function setPedido($pedido)
    {
        $this->pedido = $pedido;
    }

    public function getPedidoStatus()
    {
        return $this->pedidoStatus;
    }

    public function setPedidoStatus($pedidoStatus)
    {
        $this->pedidoStatus = $pedidoStatus;
    }
}
