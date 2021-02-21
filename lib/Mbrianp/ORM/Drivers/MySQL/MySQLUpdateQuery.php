<?php

namespace Mbrianp\FuncCollection\ORM\Drivers\MySQL;

use Mbrianp\FuncCollection\ORM\Drivers\UpdateDriverInterface;
use PDO;
use PDOStatement;

class MySQLUpdateQuery extends AbstractMySQLQuery implements UpdateDriverInterface
{
    public function __construct(PDO $connection, string $table, protected array $columns)
    {
        $this->connection = $connection;
        $this->table = $table;
    }

    protected function createSQL(): string
    {
        $sql = 'UPDATE ' . $this->table . ' SET ';

        foreach ($this->columns as $column => $value) {
            $sql .= $column . ' = ' . \var_export($value, true) . ', ';
        }

        $sql = substr($sql, 0, -2);
        $sql .= parent::createSQLConditions();

        return $sql;
    }

    public function do(): bool
    {
        $sql = $this->createSQL();

        if ($this->connection->query($sql) instanceof PDOStatement)
            return true;

        return false;
    }
}