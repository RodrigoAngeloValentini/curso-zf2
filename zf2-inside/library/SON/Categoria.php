<?php

namespace SON;

class Categoria implements CategoriaInterface
{
    private $id;
    private $nome;
    private $db;

    public function __construct(Db\Connection $db)
    {
        $this->db = $db;
    }


    public function listar()
    {
        $query = "Select * from categorias";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }


}