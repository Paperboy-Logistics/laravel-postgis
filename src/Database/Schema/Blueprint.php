<?php

namespace MStaack\LaravelPostgis\Database\Schema;

class Blueprint extends \Illuminate\Database\Schema\Blueprint
{
    public $inherits;

    public function inherits($table)
    {
        $this->inherits = $table;
    }

    protected function addFluentIndexes()
    {
        foreach ($this->columns as $column) {
            foreach (array('primary', 'unique', 'index', 'gin', 'gist') as $index) {
                if ($column->$index === true) {
                    $this->$index($column->name);
                    continue 2;
                } elseif (isset($column->$index)) {
                    $this->$index($column->name, $column->$index);
                    continue 2;
                }
            }
        }
    }

    public function gin($columns, $name = null)
    {
        return $this->indexCommand('gin', $columns, $name);
    }

    public function gist($columns, $name = null)
    {
        return $this->indexCommand('gist', $columns, $name);
    }

    public function hstore($column)
    {
        return $this->addColumn('hstore', $column);
    }
}
