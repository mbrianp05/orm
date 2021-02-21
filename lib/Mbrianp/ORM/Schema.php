<?php

namespace Mbrianp\FuncCollection\ORM;

use Mbrianp\FuncCollection\ORM\Attributes\Column;
use Mbrianp\FuncCollection\ORM\Attributes\Table;

class Schema
{
    /**
     * Schema constructor.
     * @param Table $table
     * @param Column[] $columns
     */
    public function __construct(
        public Table $table,
        public array $columns,
    )
    {
    }
}