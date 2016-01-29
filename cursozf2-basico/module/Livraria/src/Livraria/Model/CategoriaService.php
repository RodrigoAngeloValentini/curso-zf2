<?php

namespace Livraria\Model;

class CategoriaService {

    /**
     * @var Livraria\Model\CategoriaTable
     */
    protected $categoriaTable;
    
    public function __construct(CategoriaTable $table) {
        $this->categoriaTable = $table;
    }
    
    public function fetchAll() {
        $resultSet = $this->categoriaTable->select();
        return $resultSet;
    }
    
}
