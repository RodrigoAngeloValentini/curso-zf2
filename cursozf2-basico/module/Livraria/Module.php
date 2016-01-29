<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Livraria;

use Livraria\Service\Livro as LivroService;
use Livraria\Service\Categoria as CategoriaService;
use Livraria\Model\CategoriaTable;
use LivrariaAdmin\Form\Livro as LivroFrm;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ .'Admin' => __DIR__ . '/src/' . __NAMESPACE__.'Admin',
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(

                'Livraria\Model\CategoriaService' => function($service) {
                    $dbAdapter = $service->get('Zend\Db\Adapter\Adapter');
                    $categoriaTable = new CategoriaTable($dbAdapter);
                    $categoriaService = new Model\CategoriaService($categoriaTable);
                    return $categoriaService;
                },
                'Livraria\Service\Categoria' => function($service) {
                    return new CategoriaService($service->get('Doctrine\ORM\EntityManager'));
                },
                'Livraria\Service\Livro' => function($service) {
                    return new LivroService($service->get('Doctrine\ORM\EntityManager'));
                },
                'LivrariaAdmin\Form\Livro' => function($service) {
                    $em = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $em->getRepository('Livraria\Entity\Categoria');
                    $categorias = $repository->fetchPairs();
                    return new LivroFrm(null, $categorias);
                },
            ),
        );
    }
}
