<?php

namespace SON;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class CategoriaFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $connection = $serviceLocator->get('Connection');
        return new Categoria($connection);
    }

} 