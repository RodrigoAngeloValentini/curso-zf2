<?php
return array(
    // This should be an array of module namespaces used in the application.
    'modules' => array(
        'Application',
        'SON',
        'DoctrineModule',
        'DoctrineORMModule',
        'DoctrineDataFixtureModule',
        'SONBase'
    ),

    'module_listener_options' => array(
     'module_paths' => array(
            './module',
            './vendor',
        ),
        'config_glob_paths' => array(
            'config/autoload/{,*.}{global,local}.php',
            __DIR__ . '/test.config.php',
        ),
    ),
);