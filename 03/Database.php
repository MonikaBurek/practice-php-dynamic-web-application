<?php

class Database
{
    public $connection;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }

    public function select($name)
    {
        $query = 'SELECT * FROM ' . $name;

        return $this->query($query)->fetchAll();
    }

    public function delete($name, $id)
    {
        $query = "DELETE FROM " . $name . " WHERE id = :id";

        return $this->query($query, ['id' => $id]);
    }
}