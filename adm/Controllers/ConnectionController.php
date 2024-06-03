<?php

abstract class ConnectionController
{

    public $drive  = "mysql";
    public string $host   = "projeto1";
    public string $user   = "root";
    public string $pass   = "root";
    public string $dbname = "projeto";
    public int $port      = 3306;
    public object $connection;

    public function connectDb()
    {
        try {
            
            $this->connection = new PDO($this->drive . ':host=' . $this->host . ';dbname='. $this->dbname, $this->user, $this->pass);
            return $this->connection;

        } catch (Exception $e) {

            throw new PDOException($e->getMessage(), (int)$e->getCode());

        }
        
    }


}