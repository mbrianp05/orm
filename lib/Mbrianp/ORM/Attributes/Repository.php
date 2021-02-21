<?php

namespace Mbrianp\FuncCollection\ORM\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class Repository
{
    public function __construct(public string $class)
    {
    }
}