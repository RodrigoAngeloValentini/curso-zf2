<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

use Zend\ServiceManager\ServiceManager;

$serviceManager = new ServiceManager();
//$serviceManager->setService('Produto', new SON\Produto());
//
//$produto = $serviceManager->get('Produto');
//$produto2 = $serviceManager->get('Produto');
//
//var_dump((spl_object_hash($produto)) === spl_object_hash($produto2));


// InvokableClass
//$serviceManager->setInvokableClass('Produto','SON\Produto');
//$produto = $serviceManager->get('Produto');
//$produto2 = $serviceManager->get('Produto');
//
//var_dump((spl_object_hash($produto)) === spl_object_hash($produto2));


// factories
//$serviceManager->setService('Connection', new SON\Db\Connection('a','b','c','d'));

////$serviceManager->setFactory('Categoria', function($sm) {
//////    //$connection = $sm->get('Connection');
//////    //$categoria = new \SON\Categoria($connection);
//////    $categoria = new \SON\Categoria($sm->get('Connection'));
//////    return $categoria;
////    return new \SON\Categoria($sm->get('Connection'));
////});
//
//$categoria = $serviceManager->get('Categoria');
//print_r($categoria);

//$serviceManager->setFactory('Categoria','SON\CategoriaFactory');
//$categoria = $serviceManager->get('Categoria');
//print_r($categoria);

//// aliases
//$serviceManager->setService('SON\Db\Connection', new SON\Db\Connection('a','b','c','d'));
//$serviceManager->setAlias('Connection','SON\Db\Connection');
//
//print_r($serviceManager->get('Connection'));


// SharedManager
//$serviceManager->setInvokableClass('Produto','SON\Produto');
//$serviceManager->setShared('Produto', false);
//$produto = $serviceManager->get('Produto');
//$produto2 = $serviceManager->get('Produto');
//
//
//var_dump((spl_object_hash($produto)) === spl_object_hash($produto2));

// Peering Service Managers
//$serviceManagerA = new ServiceManager();
//$serviceManagerA->setInvokableClass('Produto', 'SON\Produto');
//
////$produto = $serviceManagerA->get('Produto');
//
//$serviceManagerB = $serviceManagerA->createScopedServiceManager(ServiceManager::SCOPE_PARENT);
//
////$produto = $serviceManagerB->get('Produto');
////print_r($produto);
//
//$serviceManagerC = $serviceManagerA->createScopedServiceManager(ServiceManager::SCOPE_CHILD);
////$produto = $serviceManagerC->get('Produto'); // nao funciona
//$serviceManagerC->setInvokableClass('Test','SON\Test');
//
//print_r($serviceManagerC->get('Test'));
//print_r($serviceManagerA->get('Test'));


// Initializers
//$serviceManager->setService('Connection', new SON\Db\Connection('a','b','c','d'));
//$serviceManager->setInvokableClass('Produto','SON\Produto');
//$serviceManager->setInvokableClass('Test','SON\Test');
//$serviceManager->addInitializer(function($instance, $serviceManager) {
//    if($instance instanceof SON\Produto) {
//        $instance->setDb($serviceManager->get('Connection'));
//    }
//});
//$produto = $serviceManager->get('Test');
//print_r($produto);


$serviceManager = new ServiceManager();
$config = array(
  'factories' => array(
      'Connection' => function($sm) {
            return new SON\Db\Connection('a','b','c','d');
          },
  ),
  'invokables' => array(
        'Produto' => 'SON\Produto'
  ),
  'shared' => array(
      'Produto' => false
  )
);

$serviceConfig = new Zend\Mvc\Service\ServiceManagerConfig($config);
$serviceConfig->configureServiceManager($serviceManager);

print_r($serviceManager->get('Produto'));

