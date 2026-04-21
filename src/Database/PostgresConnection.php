<?php

namespace MStaack\LaravelPostgis\Database;

use Illuminate\Database\PostgresConnection as BasePostgresConnection;

class PostgresConnection extends BasePostgresConnection
{
    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }
        return new Schema\Builder($this);
    }

    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new Schema\Grammars\PostgresGrammar);
    }

    protected function getDefaultPostProcessor()
    {
        return new \Illuminate\Database\Query\Processors\PostgresProcessor;
    }
}
