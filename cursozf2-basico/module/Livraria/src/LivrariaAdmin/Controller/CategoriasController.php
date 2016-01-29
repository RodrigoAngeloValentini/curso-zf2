<?php

namespace LivrariaAdmin\Controller;


class CategoriasController extends CrudController
{
    public function __construct()
    {
        $this->entity =  "Livraria\Entity\Categoria";
        $this->form = "LivrariaAdmin\Form\Categoria";
        $this->service = "Livraria\Service\Categoria";
        $this->controller = "categorias";
        $this->route = "livraria-admin";
    }
}