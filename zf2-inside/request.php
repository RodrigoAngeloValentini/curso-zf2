<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

/*
GET URI 1.1
HEADERS Content-Type: text/html
BODY -> Conteudo
*/

use Zend\Http\Request;

// Request GET

//$request = new Request();
//$request->setMethod(Request::METHOD_GET);
//$request->setUri("http://google.com");
//$request->setContent("Conteúdo da nossa request");
//
//echo $request->toString();

// POST
//$request = new Request();
//$request->setMethod(Request::METHOD_POST);
//$request->getPost()->set('nome','Wesley');
//$request->getPost()->set('x','10');
//$request->setUri("http://google.com");
//$request->setContent($request->getPost()->toString());
//
//echo $request->toString();


$request = new Request();
$request->setMethod(Request::METHOD_POST);
$request->getPost()->set('nome','Wesley');
$request->getHeaders()->addHeaders(array('headerX'=>10, 'headerY'=>20));
$request->getHeaders()->addHeaderLine('Content-Type: text/html');
$request->setUri("http://google.com");
$request->setContent($request->getPost()->toString());

echo $request->toString();