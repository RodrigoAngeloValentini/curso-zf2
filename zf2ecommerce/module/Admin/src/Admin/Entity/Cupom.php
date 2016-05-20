<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;

/**
 * Cupom
 *
 * @ORM\Table(name="cupom", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Cupom")
 */
class Cupom
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
     * @ORM\Column(name="codigo", type="string", length=45, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=45, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", length=250, nullable=true)
     */
    private $descricao;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_desconto", type="integer", nullable=false)
     */
    private $tipoDesconto;

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
     * @var float
     *
     * @ORM\Column(name="valor", type="float", precision=9, scale=2, nullable=false)
     */
    private $valor;

    public function __construct(array $data)
    {
        $this->dtaInc = new \DateTime('now');

        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
    }

    public function toArray()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }

    /**
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param string $descricao
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    /**
     * @return \DateTime
     */
    public function getDtaFim()
    {
        return $this->dtaFim;
    }

    /**
     * @param \DateTime $dtaFim
     */
    public function setDtaFim($dtaFim)
    {
        $date = new \DateTime($dtaFim);

        $this->dtaFim = $date;
    }

    /**
     * @return \DateTime
     */
    public function getDtaInc()
    {
        return $this->dtaInc;
    }

    /**
     * @return \DateTime
     */
    public function getDtaIni()
    {
        return $this->dtaIni;
    }

    /**
     * @param \DateTime $dtaIni
     */
    public function setDtaIni($dtaIni)
    {
        $date = new \DateTime($dtaIni);

        $this->dtaIni = $date;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return boolean
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param boolean $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return boolean
     */
    public function getTipoDesconto()
    {
        return $this->tipoDesconto;
    }

    /**
     * @param boolean $tipoDesconto
     */
    public function setTipoDesconto($tipoDesconto)
    {
        $this->tipoDesconto = $tipoDesconto;
    }

    /**
     * @return float
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param float $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
    }

}
