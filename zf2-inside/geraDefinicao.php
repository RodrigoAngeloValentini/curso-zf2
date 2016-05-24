<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();


$components = array('SON');

foreach($components as $component) {
    $diCompiler = new Zend\Di\Definition\CompilerDefinition();
    $diCompiler->addDirectory('library/'.$component);

    $diCompiler->compile();

    file_put_contents(
        'data/di/'.$component.'-definition.php',
        '<?php return '. var_export($diCompiler->toArrayDefinition()->toArray(), true).';'
    );
}