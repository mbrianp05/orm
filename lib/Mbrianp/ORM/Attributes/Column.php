<?php

namespace Mbrianp\FuncCollection\ORM\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Column
{
    public function __construct(
        public ?string $name = null,
        public ?string $type = null,
        public int $length = 255,
        public bool $unique = false,
        public bool $nullable = false,
        public array $options = [],
    )
    {

    }
}