<?php

namespace Mbrianp\FuncCollection\ORM;

class ConnectionParameters
{
    public function __construct(
        public string $host,
        public string $username,
        public string $password,
        public ?string $dbname = null,
        public string $engine = 'mysql',
    )
    {
    }
}