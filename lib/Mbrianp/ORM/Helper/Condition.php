<?php

namespace Mbrianp\FuncCollection\ORM\Helper;

class Condition
{
    public const LT = '<';
    public const GT = '>';
    public const E = '=';
    public const ALIKE = 'LIKE';

    public const CONDITION_TYPES = [
        'or' => 'OR',
        'and' => 'AND'
    ];

    public function __construct(public string $column, public string|int|float $value, public string $operator = self::E, public ?string $type = null)
    {
    }
}