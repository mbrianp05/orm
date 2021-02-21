<?php

namespace Mbrianp\FuncCollection\ORM;

use Mbrianp\FuncCollection\DIC\DependenciesDefinitionInterface;
use Mbrianp\FuncCollection\DIC\DIC;
use Mbrianp\FuncCollection\DIC\Service;

class ORMDependenciesDefinition implements DependenciesDefinitionInterface
{
    public function __construct(DIC $dependenciesContainer, protected array $config)
    {
    }

    public function getServices(): array
    {
        $params = [
            $this->config['host'],
            $this->config['username'],
            $this->config['password'],
            $this->config['dbname'],
            $this->config['engine'],
        ];

        $ormService = $services[] = new Service('db.orm', ORM::class, $params);
        $services[] = new Service('db.entity_manager', EntityManager::class, [$ormService->newInstance()->getDriver()]);

        return $services;
    }
}