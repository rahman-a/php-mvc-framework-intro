<?php

namespace Core;

use PDO;

class Database
{

    protected $connection;
    protected $statement;

    public function __construct($config, $username, $password)
    {
        $connectionString = "mysql:" . http_build_query($config, '', ';');

        $this->connection = new PDO($connectionString, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {

        $this->statement = $this->connection->prepare($query);

        $this->statement->execute($params);

        return $this;
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findAll()
    {
        return $this->statement->fetchAll();
    }

    public function findOrAbort()
    {
        $result = $this->statement->fetch();

        if (!$result) {
            abort();
        }

        return $result;
    }

    public function findAllOrAbort()
    {
        $result = $this->statement->fetchAll();

        if (!$result) {
            abort();
        }

        return $result;
    }
}
