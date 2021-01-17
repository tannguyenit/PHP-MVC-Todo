<?php

namespace App\App\Database;

use \PDO;

class QueryBuilder
{
    protected $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function selectAll(string $table, string $fetchClass = null)
    {
        $query = $this->db->prepare("select * from {$table};");
        $query->execute();

        if ($fetchClass) {
            return $query->fetchAll(PDO::FETCH_CLASS, $fetchClass);
        }

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById(string $table, int $id, string $fetchClass = null)
    {
        $query = $this->db->prepare("select * from {$table} where id = {$id};");
        $query->execute();

        return $query->fetchObject($fetchClass);
    }

    public function insert(string $table, array $parameters)
    {
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );
        $query = $this->db->prepare($sql);
        $query->execute($parameters);
    }

    public function update(string $table, int $id, array $parameters)
    {
        $sql = "UPDATE {$table} SET ";

        foreach ($parameters as $k => $v) {
            $sql .= "{$k} = '{$v}',";
        }

        $sql = rtrim($sql, ", ");
        $sql .= " where id = {$id};";

        $query = $this->db->prepare($sql);
        $query->execute();
    }


    public function delete(string $table, int $id)
    {
        $sql = "DELETE FROM {$table} WHERE id = {$id};";
        $query = $this->db->prepare($sql);
        $query->execute();
    }
}
