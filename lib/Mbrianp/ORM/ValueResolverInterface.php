<?php

namespace Mbrianp\FuncCollection\ORM;

interface ValueResolverInterface
{
    public function resolve(array $values): mixed;
}