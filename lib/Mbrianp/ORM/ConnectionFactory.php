<?php

namespace Mbrianp\FuncCollection\ORM;

use LogicException;
use Mbrianp\FuncCollection\ORM\Drivers\DatabaseDriverInterface;
use Mbrianp\FuncCollection\ORM\Drivers\MySQL\MySQLDriver;
use PDO;

/**
 * This class prepares the proper Driver for the choice engine.
 * A PDO connection will be set from the given parameters
 * and will be passed to the Driver as parameter.
 */
class ConnectionFactory
{
    protected const AVAILABLE_DRIVERS = ['mysql' => MySQLDriver::class];

    public function __construct(protected ConnectionParameters $parameters)
    {
    }

    /**
     * Creates the necessary DSN for the PDO connection
     */
    protected function generateDSN(): string
    {
        $dsn = $this->parameters->engine;
        $dsn .= ':host=' . $this->parameters->host;
        $dsn .= $this->parameters->dbname ? ';dbname=' . $this->parameters->dbname : '';

        return $dsn;
    }

    /**
     * Whatever the driver is, it needs a PDO connection
     * This connection will be set from the Parameters given in the constructor parameter
     */
    protected function getPDOConnection(): PDO
    {
        return new PDO($this->generateDSN(), $this->parameters->username, $this->parameters->password);
    }

    /**
     * For getting the Driver according to the selected engine
     */
    public function getDriverConnection(): DatabaseDriverInterface
    {
        if (!\in_array($this->parameters->engine, \array_keys(static::AVAILABLE_DRIVERS))) {
            throw new LogicException(\sprintf('Invalid engine %s, expected on of these: %s', $this->parameters->engine, implode(' ', \array_keys(static::AVAILABLE_DRIVERS))));
        }

        $driverClass = static::AVAILABLE_DRIVERS[$this->parameters->engine];

        return new $driverClass($this->getPDOConnection());
    }
}