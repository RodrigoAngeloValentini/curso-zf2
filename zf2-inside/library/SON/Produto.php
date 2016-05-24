<?php

namespace SON;

class Produto
{
    private $categoria;
    private $db;

    public function addCategoria(CategoriaInterface $categoria)
    {
        $this->categoria[] = $categoria;
    }

    public function setDb(Db\Connection $db)
    {
        $this->db = $db;
        return $this;
    }

    public function getDb()
    {
        return $this->db;
    }

}