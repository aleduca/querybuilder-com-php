<?php

namespace Database\Query;

use Database\Query\interfaces\IBuilder;

class QueryBuilder
{
    protected $queries = [
        'select' => '',
        'table' => '',
        'limit' => '',
        'join' => []
    ];

    public function select($fields = '*')
    {
        $this->queries['select'] = $fields;
        return $this;
    }

    public function table($table)
    {
        $this->queries['table'] = $table;
        return $this;
    }

    public function limit($limit)
    {
        $this->queries['limit'] = $limit;
        return $this;
    }

    public function join($table, $foreignKey)
    {
        $this->queries['join'][$foreignKey] = " inner join {$table} on {$table}.id = {$this->queries['table']}.{$foreignKey}";
        return $this;
    }

    public function execute(IBuilder $builder)
    {
        $execute = new Execute;
        $execute->setQuery($this->queries);
        $execute->execute($builder);
    }
}
