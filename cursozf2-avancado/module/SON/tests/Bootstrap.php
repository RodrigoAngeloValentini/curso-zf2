<?php

namespace SON;

require_once(getcwd() . '/../../../vendor/wesleywillians/son-base/src/SONBase/Test/AbstractBootstrap.php');

use SONBase\Test\AbstractBootstrap;

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

class Bootstrap extends AbstractBootstrap 
{

}

Bootstrap::init();