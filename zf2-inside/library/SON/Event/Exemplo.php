<?php

namespace SON\Event;

use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManager;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;

class Exemplo implements EventManagerAwareInterface
{

    protected $events;

    public function setEventManager(EventManagerInterface $events)
    {
        $events->setIdentifiers(array(
           __CLASS__,
            get_called_class()
        ));

        $this->events = $events;
        return $this;
    }

    public function getEventManager()
    {
        if(null == $this->events) {
            $this->setEventManager(new EventManager());
        }
        return $this->events;
    }



    public function metodo($valor)
    {
        echo "Metodo executou.<br>";

        $this->getEventManager()->trigger(
          __FUNCTION__,
          $this,
          array('valor'=>$valor)
        );

    }

    public function metodo2()
    {
        $this->getEventManager()->trigger(
            __FUNCTION__,
            $this,
            array('valor'=>'valor qualquer')
        );
    }

    public function metodo3($valor)
    {
        $arg = compact('valor');
        $results = $this->getEventManager()->triggerUntil(
                    __FUNCTION__,
                    $this,
                    $arg,
                    function ($v) use ($valor) {
                        if($valor == 1) {
                            return true;
                        }
                    }
                );

        if($results->stopped()) {
            echo "Parou a execução";
            return $results->last();
        }

        echo "Execução continuando...";

        // Execucao vai continuando...
    }

    public function multiplosEventos($valor)
    {
        $arg = compact('valor');

        $this->getEventManager()->trigger(
            __FUNCTION__.'.pre',
            $this,
            $arg
        );

        echo "Conteudo do metodo sendo executado<br>";

        $this->getEventManager()->trigger(
            __FUNCTION__.'.post',
            $this,
            array('valor'=>'executou depois')
        );

    }

}