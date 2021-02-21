<?php

namespace Mbrianp\FuncCollection\ORM\Type;

interface ORMTypeInterface
{
    public function resolveToSQL(mixed $data): mixed;

    public function resolveToPHP(string $data): mixed;

    /**
     * Returns the data type that will be stored into the database, like:
     *
     * string, integer, etc.
     */
    public static function getFinalType(): string;
}