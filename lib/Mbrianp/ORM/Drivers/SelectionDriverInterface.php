<?php

namespace Mbrianp\FuncCollection\ORM\Drivers;

use PDO;

interface SelectionDriverInterface extends QueryDriverInterface
{
    public function __construct(PDO $connection, string $table);

    public function limit(int $limit): static;

    public function orderBy(array $order): static;

    /**
     * If no result or more than one
     * was found then an exception is thrown
     *
     * @return array
     */
    public function getSingleResult(): array;

    public function getOneOrNullResult(): ?array;

    public function getResults(): array;
}