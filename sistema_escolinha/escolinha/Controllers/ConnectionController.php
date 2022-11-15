<?php

abstract class ConnectionController
{

    public $drive  = "mysql";
    public string $host   = "projeto1";
    public string $user   = "root";
    public string $pass   = "root";
    public string $dbname = "AcademiaSCI";
    public int $port      = 3306;
    public object $connection;

    public function connectDb()
    {
        try {
            
            $this->connection = new PDO($this->drive . ':host=' . $this->host . ';dbname='. $this->dbname, $this->user, $this->pass);
            return $this->connection;

        } catch (Exception $e) {

            echo "Entre em contato com o administrador do sistema (00) 0000-0000";

        }
        
    }

}