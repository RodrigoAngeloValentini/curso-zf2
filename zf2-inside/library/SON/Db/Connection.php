<?php

namespace SON\Db;

class Connection
{

    private $server;
    private $dbname;
    private $user;
    private $password;

    public function __construct($server, $dbname, $user, $password)
    {
        $this->server = $server;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->password = $password;

        #return new \PDO("mysql:host={$this->server};dbname={$this->dbname}",$this->user,$this->password);
    }

}