<?php

namespace Mbrianp\FuncCollection\ORM\Drivers\MySQL;

use Mbrianp\FuncCollection\ORM\Drivers\SelectionDriverInterface;
use Mbrianp\FuncCollection\ORM\Helper\Selection;
use PDO;
use RuntimeException;

class MySQLSelectionQuery extends AbstractMySQLQuery implements SelectionDriverInterface
{
    protected Selection $selection;
    protected ?int $limit = null;
    protected array $orderBy = [];

    public function __construct(PDO $connection, string $table, array|string|null $fields = [])
    {
        parent::__construct($connection, $table);
        
        // Convert $fields to array
        if (empty($fields)) {
            $fields = [];
        } elseif (\is_string($fields)) {
            $fields = [$fields];
        }

        $this->selection = new Selection($fields);
    }

    public function limit(int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    public function orderBy(array $order = []): static
    {
        $this->orderBy = $order;

        return $this;
    }

    public function getSingleResult(): array
    {
        $results = $this->getResults();

        if (count($results) != 1) {
            throw new RuntimeException('No result was found');
        }

        return $results[0];
    }

    public function getOneOrNullResult(): array|null
    {
        $results = $this->getResults();

        if (empty($results)) {
            return null;
        }

        return $results;
    }

    public function getResults(): array
    {
        $sql = $this->createSQL();

        return $this->executeQuery($sql);
    }

    protected function createSQL(): string
    {
        $sql = 'SELECT ';

        if (empty($this->selection->fields)) {
            $sql .= '*';
        } else {
            $sql .= implode(', ', $this->selection->fields);
        }

        $sql .= ' FROM ' . $this->table . parent::createSQLConditions();

        if (!empty($this->orderBy)) {
            $sql .= ' ORDER BY ';

            foreach ($this->orderBy as $column => $order) {
                $sql .= $column . ' ' . $order . ', ';
            }

            $sql = substr($sql, 0, -2);
        }

        if (null !== $this->limit) {
            $sql .= ' LIMIT ' . $this->limit;
        }

        return $sql;
    }

    public function executeQuery(string $query): array
    {
        return $this->connection->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }
}