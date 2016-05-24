<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

/*

Evento:
- LoadModules (lista e pega todos os modulos da aplicação) foreach
    * Zend\Loader\ModuleAutoloader
 *
- LoadModule
    - loadmodule.resolve (new Module();) instancia o objeto do modulo
    - loadmodule

        - getAutoloaderConfig() - possibilita ter seu proprio autoloader
        - getConfig() - merge em relacao ao seu framework
        - init(ModuleManager) - leve, somente o necessario
        - onBootstrap       - Zend\Mvc () - bootstrap event
        - LocatorRegistrationListener implementar interface Zend\ModuleManager\Feature\LocatorRegisterdInterface
        - ServiceListener (somente zend\mvc) services, controllers, plugins, view_helpers
    - loadModules.post - todos os modulos ja foram carregados, agora eu posso atachar meus listener
 */

use Zend\ModuleManager\Listener;
use Zend\ModuleManager\ModuleManager;

$listenerOptions = new Listener\ListenerOptions(array(
   'module_paths' => array(
       './modules'
   )
));

$aggregateListener = new Listener\DefaultListenerAggregate($listenerOptions);

$moduleManager = new ModuleManager(array(
    'Modulo'
));
$moduleManager->getEventManager()->attachAggregate($aggregateListener);

$moduleManager->loadModules();