<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

$definitionList = new Zend\Di\DefinitionList(array(
   #new Zend\Di\Definition\ArrayDefinition(include __DIR__ . '/data/di/SON-definition.php'),
   $runtime = new Zend\Di\Definition\RuntimeDefinition()
));

$di = new Zend\Di\Di($definitionList);

//$di->instanceManager()->setParameters('SON\Db\Connection', array(
//   'server' => 'localhost',
//    'dbname' => 'banco',
//    'user' => 'username',
//    'password' => 123
//));

$di->instanceManager()->addAlias('conexao1', 'SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco',
    'user' => 'username',
    'password' => 123
));

$di->instanceManager()->addAlias('conexao2', 'SON\Db\Connection', array(
    'server' => 'localhost',
    'dbname' => 'banco2',
    'user' => 'username',
    'password' => 1234
));

$conexao1 = $di->get('conexao1');
$conexao2 = $di->get('conexao2');

$di->instanceManager()->addTypePreference('SON\Db\Connection', 'conexao1');

$categoria = $di->get('SON\Categoria', array('db'=>'conexao2'));

#$di = new Zend\Di\Di;
//$di->configure(new Zend\Di\Config(array(
//    'definition' => array(
//        'class' => array(
//            'SON\Produto' => array(
//                'setCategoria' => array('required'=>true)
//            )
//        )
//    )
//)));

$di->configure(new Zend\Di\Config(array(
    'definition' => array(
        'class' => array(
            'SON\Produto' => array(
                'addCategoria' => array(
                    'categoria' => array(
                        'type'=>'SON\CategoriaInterface',
                        'required'=>true
                    )
                )
            )
        )
    ),
    'instance' => array(
        'SON\Produto' => array(
            'injections' => array(
                'SON\Categoria',
                'SON\Category',
                'SON\Categoria'
            )
        )
    )
)));

$produto = $di->get('SON\Produto');

print_r($produto);

