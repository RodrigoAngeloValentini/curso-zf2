<?php

namespace Admin\Entity;

use Zend\Stdlib\Hydrator\ClassMethods;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acl
 *
 * @ORM\Table(name="acl", uniqueConstraints={@ORM\UniqueConstraint(name="id_UNIQUE", columns={"id"})}, indexes={@ORM\Index(name="fk_acl_perfil1_idx", columns={"perfil_id"}), @ORM\Index(name="fk_acl_resource1_idx", columns={"resource_id"})})
 * @ORM\Entity(repositoryClass="Admin\Repository\Acl")
 */
class Acl
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
     * @ORM\Column(name="permissao", type="string", length=5, nullable=false)
     */
    private $permissao;

    /**
     * @var \Perfil
     *
     * @ORM\ManyToOne(targetEntity="Perfil")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="perfil_id", referencedColumnName="id")
     * })
     */
    private $perfil;

    /**
     * @var \Resource
     *
     * @ORM\ManyToOne(targetEntity="Resource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resource;

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

    public function getPermissao()
    {
        return $this->permissao;
    }

    public function setPermissao($permissao)
    {
        $this->permissao = $permissao;
    }

    public function getPerfil()
    {
        return $this->perfil;
    }

    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }

    public function getResource()
    {
        return $this->resource;
    }

    public function setResource($resource)
    {
        $this->resource = $resource;
    }
}
