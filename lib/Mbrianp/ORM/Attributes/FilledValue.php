<?php

namespace Mbrianp\FuncCollection\ORM\Attributes;

use Attribute;
use Mbrianp\FuncCollection\ORM\ValueResolverInterface;

/**
 * When the value of the column is the value of another columns
 * You can use this attribute to define it.
 *
 * Example:
 *      #[Column]
 *      public string $name;
 *
 *      #[Column]
 *      public string $lastname;
 *
 *      #[Column]
 *      #[FilledValue(['name', 'lastname'])]
 *      public string $fullName;
 */
#[Attribute(Attribute::TARGET_PROPERTY)]
class FilledValue implements ValueResolverInterface
{
    public function __construct(
        public array $columns,
        public ?string $pattern = null,
    )
    {
    }

    public function resolve(array $values): string
    {
        $values = \array_filter($values, fn(string $key): bool => \in_array($key, $this->columns),\ARRAY_FILTER_USE_KEY);
        $pattern = \trim(\str_repeat('%s ', \count($values)));


        if (null !== $this->pattern) {
            $pattern = $this->pattern;
        }

        return \sprintf($pattern, ...\array_values($values));
    }
}