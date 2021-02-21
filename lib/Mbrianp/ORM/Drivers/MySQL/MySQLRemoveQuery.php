<?php

namespace Mbrianp\FuncCollection\ORM\Drivers\MySQL;

use Mbrianp\FuncCollection\ORM\Drivers\RemoveDriverInterface;
use PDOStatement;

class MySQLRemoveQuery extends AbstractMySQLQuery implements RemoveDriverInterface
{
    protected function createSQL(): string
    {
        $sql = 'DELETE ' . $this->table;
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