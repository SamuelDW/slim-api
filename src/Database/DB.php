<?php

namespace App\Database;

use \PDO;

class DB
{
    private string $host = 'localhost';
    private string $user = 'sam';
    private string $password = 'kiki270621';
    private string $databaseName = 'slim_api';

    /**
     *
     */
    public function connect()
    {
        $connectionString = "mysql:host=$this->host;dbname=$this->databaseName";
        $connection = new PDO($connectionString, $this->user, $this->password);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $connection;
    }
}
