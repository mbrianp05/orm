<?php

namespace Mbrianp\FuncCollection\ORM\Drivers;

use Mbrianp\FuncCollection\ORM\Helper\Condition;
use PDO;

interface QueryDriverInterface
{
    public function where(string $field, string|int|float $value, string $operator = Condition::E): static;

    public function orWhere(string $field, string|int|float $value, string $operator = Condition::E): static;

    public function andWhere(string $field, string|int|float $value, string $operator = Condition::E): static;
}