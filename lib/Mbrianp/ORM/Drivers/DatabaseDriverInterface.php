<?php

namespace Mbrianp\FuncCollection\ORM\Drivers;

use Mbrianp\FuncCollection\ORM\Schema;
use PDO;

interface DatabaseDriverInterface
{
    /**
     * If the fields parameters is "" or null means that
     * everything must be selected.
     *
     * @param string $table
     * @param string|array|null $fields
     * @return QueryDriverInterface
     */
    public function select(string $table, string|array|null $fields = null): SelectionDriverInterface;

    public function remove(string $table): RemoveDriverInterface;

    public function update(string $table, array $fields): UpdateDriverInterface;

    public function insert(string $table, array $values): bool;

    public function createTable(Schema $schema): bool;

    public function createDatabase(string $name): bool;

    public function addSQL(string $sql): void;

    public function do(): void;

    /**
     * Will convert a PHP Type (like string, integer, json) into SQL Type (like VARCHAR, INT, VARCHAR, respectively)
     *
     * @param string $phptype
     * @return string
     */
    public static function resolveType(string $phptype): string;

    public function __construct(PDO $connection);
}