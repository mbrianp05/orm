<?php

namespace Mbrianp\FuncCollection\ORM;

use Mbrianp\FuncCollection\ORM\Attributes\FilledValue;
use Mbrianp\FuncCollection\ORM\Drivers\DatabaseDriverInterface;
use Mbrianp\FuncCollection\ORM\Type\Json;

class ORM
{
    protected static array $valueResolvers = [FilledValue::class];
    protected static array $types = ['json' => Json::class];

    protected ConnectionParameters $parameters;
    protected ConnectionFactory $connection;
    protected DatabaseDriverInterface $driver;

    public function __construct(
        string $host,
        string $username,
        string $password,
        ?string $dbname = null,
        string $engine = 'mysql',
    )
    {
        $this->parameters = new ConnectionParameters($host, $username, $password, $dbname, $engine);
        $this->connection = new ConnectionFactory($this->parameters);
        $this->driver = $this->connection->getDriverConnection();
    }

    public function getDriver(): DatabaseDriverInterface
    {
        return $this->driver;
    }

    public function getSchemaGenerator(): SchemaGenerator
    {
        return new SchemaGenerator($this->driver);
    }

    public function getEntityManager(): EntityManager
    {
        return new EntityManager($this->driver);
    }

    public static function getValueResolvers(): array
    {
        return static::$valueResolvers;
    }

    public static function getTypes(): array
    {
        return static::$types;
    }
}