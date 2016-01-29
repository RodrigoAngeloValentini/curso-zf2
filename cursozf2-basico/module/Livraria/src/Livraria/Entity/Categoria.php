<?php

namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator\ClassMethods;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="categorias")
 * @ORM\Entity(repositoryClass="Livraria\Entity\CategoriaRepository")
 */
class Categoria
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\OneToMany(targetEntity="Livraria\Entity\Livro", mappedBy="categoria")
     *
     */
    protected $livros;


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

    public function __toString(){
        return $this->nome;
    }

    public function getLivros(){
        return $this->livros;
    }



    //    public function __construct($options = null) {
    //        Configurator::configure($this,$options);
    //        $this->livros = new ArrayCollection();
    //    }

    public function __construct(array $data)
    {
        $hydrator = new ClassMethods();
        $hydrator->hydrate($data, $this);
        $this->livros = new ArrayCollection();
    }

    public function toArray()
    {
        $hydrator = new ClassMethods();
        return $hydrator->extract($this);
    }
    //    public function toArray(){
    //        return array('id'=>$this->getId(),'nome' => $this->getNome());
    //    }
}