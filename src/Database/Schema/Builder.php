<?php

namespace MStaack\LaravelPostgis\Database\Schema;

use Closure;

class Builder extends \Illuminate\Database\Schema\PostgresBuilder
{
    protected function createBlueprint($table, Closure $callback = null)
    {
        return new Blueprint($table, $callback);
    }
}
