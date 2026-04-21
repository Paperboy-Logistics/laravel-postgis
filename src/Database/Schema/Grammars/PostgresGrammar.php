<?php

namespace MStaack\LaravelPostgis\Database\Schema\Grammars;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint as BaseBlueprint;
use MStaack\LaravelPostgis\Database\Schema\Blueprint;

class PostgresGrammar extends \Illuminate\Database\Schema\Grammars\PostgresGrammar
{
    protected function typeHstore(Fluent $column)
    {
        return "hstore";
    }

    public function compileGin(Blueprint $blueprint, Fluent $command)
    {
        $columns = $this->columnize($command->columns);
        return sprintf('CREATE INDEX %s ON %s USING GIN(%s)', $command->index, $this->wrapTable($blueprint), $columns);
    }

    public function compileGist(Blueprint $blueprint, Fluent $command)
    {
        $columns = $this->columnize($command->columns);
        return sprintf('CREATE INDEX %s ON %s USING GIST(%s)', $command->index, $this->wrapTable($blueprint), $columns);
    }

    public function compileCreate(BaseBlueprint $blueprint, Fluent $command)
    {
        $sql = parent::compileCreate($blueprint, $command);
        if (isset($blueprint->inherits)) {
            $sql .= ' INHERITS ("'.$blueprint->inherits.'")';
        }
        return $sql;
    }
}
