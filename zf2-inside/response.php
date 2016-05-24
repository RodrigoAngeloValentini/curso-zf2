<?php

require_once 'library/Zend/Loader/StandardAutoloader.php';
$loader = new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespace('SON', 'library/SON');
$loader->register();

/*
VERSION | 200 OK Reason
HEADERS
BODY - Content
*/

use Zend\Http\Response;

$response = new Response();
$response->setStatusCode(Response::STATUS_CODE_200);
$response->getHeaders()->addHeaderLine('X-Token: JKLF54353DJKLDFD');
$response->getHeaders()->addHeaderLine('Content-Type: text/html');
$response->setContent(<<<EEE
<html>
<body>
Ola mundo
</body>
</html>
EEE
);


echo $response->toString();
