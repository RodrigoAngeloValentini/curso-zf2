<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

use Zend\Http\Request;
use Zend\Http\Client;

//$client = new Client('http://www.google.com');
//$response = $client->send();
//echo $response->getBody();


//$request = new Request();
//$request->setMethod(Request::METHOD_GET);
//$request->setUri('http://www.google.com');
//$request->getHeaders()->addHeaderLine('nome: Wesley');
//
//$client = new Client();
//$client->dispatch($request);
//echo $client->getResponse()->toString();


//$request = new Request();
//$request->setMethod(Request::METHOD_GET);
//$request->setUri('http://google.com');
//$request->getHeaders()->addHeaderLine('nome: Wesley');
//
//$client = new Client('http://google.com', array(
//    'maxredirects' => 1
//));
//$client->dispatch($request);
//echo $client->getResponse()->toString();


//$config = array(
//  'adapter' => 'Zend\Http\Client\Adapter\Socket',
//  'ssltransport' => 'tls'
//);
//
//$client = new Client('http://www.google.com', $config);
//$response = $client->send();
//echo $response->toString();

$config = array(
    'adapter' => 'Zend\Http\Client\Adapter\Curl',
    'curloptions' => array(CURLOPT_FOLLOWLOCATION => true),
);

$client = new Client('http://www.google.com', $config);
$response = $client->send();
echo $response->toString();