<?php

namespace MStaack\LaravelPostgis\Database\Connectors;

use PDO;
use MStaack\LaravelPostgis\Database\PostgresConnection;

class ConnectionFactory extends \Illuminate\Database\Connectors\ConnectionFactory
{
    protected function createConnection($driver, $connection, $database, $prefix = '', array $config = [])
    {
        if ($this->container->bound($key = "db.connection.{$driver}")) {
            return $this->container->make($key, [$connection, $database, $prefix, $config]);
        }

        if ($driver === 'pgsql') {
            return new PostgresConnection($connection, $database, $prefix, $config);
        }

        return parent::createConnection($driver, $connection, $database, $prefix, $config);
    }
}
