<?php

namespace Livraria\Entity;

class Configurator {
    /** Configure a target object with the provided options.
     *
     *  The options passed in must be a Traversable object with option names for keys.
     *  Option names are case insensitive and will be stripped of underscores. By convention,
     *  option names are in lowercase and with underscores separated words.
     *
     *  The target object is expected to have a setter method for each option passed. By convention,
     *  setters are named using camelcase with a 'set' prefix.
     *
     *  Example: option_name -> setOptionName()
     *
     *  @param object $target The object that needs to be configured.
     *  @param \Traversable $options The configuration to apply. Traversable is amongst
    others implemented by Zend\Config and arrays
     *  @param boolean $tryCall When true and $target has a __call() function, try call if no setter is available.
     *  @return void Nothing

     */
    public static function configure($target, $options, $tryCall=false)
    {
        if ( !is_object($target) )
        {
            throw new \Exception('Target should be an object');
        }
        if ( !($options instanceof Traversable) && !is_array($options) )
        {
            throw new \Exception('$options should implement Traversable');
        }

        $tryCall = (bool) $tryCall && method_exists($target, '__call');

        foreach ($options as $name => &$value)
        {
            $setter = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $name)));

            if( $tryCall || method_exists($target,$setter) )
            {
                call_user_func(array($target,$setter),$value);
            }
            else
            {
                continue; // instead of throwing an exception
            }
        }
        return $target;
    }

}

