<?php

namespace Core;

return array(
    'service_manager' => array(
        'invokables' => array(
        	'core-collection-form' => 'Core\Collection\Form',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
    ),    
);
