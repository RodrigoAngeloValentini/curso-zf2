<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Frete
 *
 * @ORM\Table(name="frete", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_frete_transporte1_idx", columns={"transporte_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Frete")
 */
class Frete
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
     * @ORM\Column(name="faixa_cep_de", type="string", length=10, nullable=false)
     */
    private $faixaCepDe;

    /**
     * @var string
     *
     * @ORM\Column(name="faixa_cep_ate", type="string", length=10, nullable=false)
     */
    private $faixaCepAte;

    /**
     * @var float
     *
     * @ORM\Column(name="vlr", type="float", precision=9, scale=2, nullable=false)
     */
    private $vlr;

    /**
     * @var \Transporte
     *
     * @ORM\ManyToOne(targetEntity="Transporte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transporte_id", referencedColumnName="id")
     * })
     */
    private $transporte;

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

    public function getFaixaCepDe()
    {
        return $this->faixaCepDe;
    }

    public function setFaixaCepDe($faixaCepDe)
    {
        $this->faixaCepDe = $faixaCepDe;
    }

    public function getFaixaCepAte()
    {
        return $this->faixaCepAte;
    }

    public function setFaixaCepAte($faixaCepAte)
    {
        $this->faixaCepAte = $faixaCepAte;
    }

    public function getVlr()
    {
        return $this->vlr;
    }

    public function setVlr($vlr)
    {
        $this->vlr = $vlr;
    }

    public function getTransporte()
    {
        return $this->transporte;
    }

    public function setTransporte($transporte)
    {
        $this->transporte = $transporte;
    }
}
