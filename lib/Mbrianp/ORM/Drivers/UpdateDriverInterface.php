<?php

namespace Mbrianp\FuncCollection\ORM\Drivers;

use PDO;

interface UpdateDriverInterface extends QueryDriverInterface
{
    public function __construct(PDO $connection, string $table, array $columns);

    public function do(): bool;
}