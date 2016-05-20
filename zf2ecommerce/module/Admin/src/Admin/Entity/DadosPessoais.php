<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * DadosPessoais
 *
 * @ORM\Table(name="dados_pessoais", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_dados_pessoais_usuario1_idx", columns={"usuario_id"})})
 * @ORM\Entity
 */
class DadosPessoais
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
     * @ORM\Column(name="rg", type="string", length=15, nullable=false)
     */
    private $rg;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=15, nullable=false)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=15, nullable=false)
     */
    private $telefone;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=15, nullable=true)
     */
    private $celular;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;

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

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
}
