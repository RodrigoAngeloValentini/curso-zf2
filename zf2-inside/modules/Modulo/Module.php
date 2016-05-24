<?php

namespace Modulo;

use Zend\ModuleManager\ModuleManager;
use Zend\EventManager\EventInterface as Event;

class Module
{

    public function init(ModuleManager $moduleManager)
    {
        ##print_r($moduleManager->getModule('Modulo'));
        $eventManager = $moduleManager->getEventManager();
        $eventManager->attach('loadModules.post', array($this, 'getModulosCarregados'));
    }

    public function getModulosCarregados(Event $e)
    {
        echo $e->getName()."<br>";
        echo get_class($e->getTarget());
        $moduleManager = $e->getTarget();

        print_r($moduleManager->getLoadedModules());
    }

}

