<?php

namespace Mbrianp\FuncCollection\ORM\Drivers;

use PDO;

interface RemoveDriverInterface extends QueryDriverInterface
{
    public function __construct(PDO $connection, string $table);

    public function do(): bool;
}