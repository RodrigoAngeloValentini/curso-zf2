<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

//$exemplo = new SON\Event\Exemplo();
//
//$exemplo->getEventManager()->attach('metodo', function($e) {
//   echo $e->getName()."<br>";
//   echo get_class($e->getTarget())."<br>";
//   echo $e->getParam('valor')."<br>";
//});

$events = new Zend\EventManager\SharedEventManager();
//$events->attach('SON\Event\Exemplo', 'metodo', function($e) {
//    echo $e->getName()."<br>";
//    echo get_class($e->getTarget())."<br>";
//    echo $e->getParam('valor')."<br>";
//});

//$events->attach('SON\Event\Exemplo', array('metodo','metodo2'), function($e) {
//    echo $e->getName()."<br>";
//    echo get_class($e->getTarget())."<br>";
//    echo $e->getParam('valor')."<br>";
//});

$events->attach('SON\Event\Exemplo', 'metodo', function($e) {
    echo $e->getName()."<br>";
    echo get_class($e->getTarget())."<br>";
    echo $e->getParam('valor')."<br>";
});


//$events->attach('SON\Event\Exemplo', 'multiplosEventos.post', function($e) {
//    echo "Executou post<br>";
//});
//
//$events->attach('SON\Event\Exemplo', 'multiplosEventos.pre', function($e) {
//    echo "Executou pre<br>";
//});

//print_r($events->getEvents('SON\Event\Exemplo'));die;

//print_r($events->getListeners('SON\Event\Exemplo','*'));

// $events->clearListeners('SON\Event\Exemplo'); // limpa os listeners

//$exemplo = new SON\Event\Exemplo;
#$exemplo->metodo(20);
#$exemplo->metodo3(1);

$exemploListener = new SON\Event\ExemploListener;
$exemplo = new SON\Event\Exemplo;
$exemplo->getEventManager()->attachAggregate($exemploListener);

$exemplo->multiplosEventos(1);