<?php

namespace Admin\Repository;

class Atributo extends AbstractRepository
{
    public function getNome($atributo)
    {
        return $this->find($atributo)->getNome();
    }
}