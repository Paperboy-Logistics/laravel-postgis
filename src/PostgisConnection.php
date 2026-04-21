<?php

namespace MStaack\LaravelPostgis;

use MStaack\LaravelPostgis\Database\PostgresConnection;
use MStaack\LaravelPostgis\Schema\Grammars\PostgisGrammar;

class PostgisConnection extends PostgresConnection
{
    /**
     * Get the default schema grammar instance.
     *
     * @return \Illuminate\Database\Grammar
     */
    protected function getDefaultSchemaGrammar()
    {
        return $this->withTablePrefix(new PostgisGrammar());
    }


    public function getSchemaBuilder()
    {
        if ($this->schemaGrammar === null) {
            $this->useDefaultSchemaGrammar();
        }

        return new Schema\Builder($this);
    }
}
