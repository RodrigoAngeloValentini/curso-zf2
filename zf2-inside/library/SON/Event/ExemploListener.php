<?php

namespace SON\Event;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\EventManager;

class ExemploListener implements ListenerAggregateInterface
{

    protected $listeners = array();

    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('multiplosEventos.pre', array($this, 'executaPre'), 100);
        $this->listeners[] = $events->attach('multiplosEventos.post', array($this, 'executaPost'), -100);
    }

    public function detach(EventManagerInterface $events)
    {
        foreach($this->listeners as $k=>$listener) {
            if($events->detach($listener))
                unset($this->listeners[$k]);
        }
    }

    public function executaPre()
    {
        echo "Executou pre<br>";
    }

    public function executaPost()
    {
        echo "Executou post<br>";
    }

}