<?php

namespace Mbrianp\FuncCollection\ORM\Type;

use Mbrianp\FuncCollection\ORM\Attributes\Column;

class Json implements ORMTypeInterface
{
    public function resolveToSQL(mixed $data): string
    {
        return json_encode($data);
    }

    public function resolveToPHP(string $data): array
    {
        return json_decode($data);
    }

    public static function getFinalType(): string
    {
        return 'string';
    }
}