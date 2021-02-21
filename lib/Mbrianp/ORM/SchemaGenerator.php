<?php

namespace Mbrianp\FuncCollection\ORM;

use Mbrianp\FuncCollection\ORM\Drivers\DatabaseDriverInterface;

class SchemaGenerator
{
    public function __construct(protected DatabaseDriverInterface $driver)
    {
    }

    /**
     * Creates the database.
     */
    public function createDatabase(string $name): bool
    {
        return $this->driver->createDatabase($name);
    }

    /**
     * Creates a table from the metadata obtained from attributes of the entity.
     */
    public function createEntityTable(string|object $entity): bool
    {
        $metadataResolver = new EntityMetadataResolver($entity);
        $schema = $metadataResolver->getSchema();

        foreach ($schema->columns as $column) {
            if (\array_key_exists($column->type, ORM::getTypes())) {
                $type = ORM::getTypes()[$column->type];
                Utils::checkType($type);

                $column->type = $type::getFinalType();
            }
        }

        return $this->driver->createTable($schema);
    }
}