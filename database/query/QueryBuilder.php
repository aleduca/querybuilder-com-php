<?php

namespace Database\Query;

use Exception;
use Database\Query\interfaces\IBuilder;

class QueryBuilder
{
    protected $queries = [
        'select' => '',
        'table' => '',
        'limit' => '',
        'join' => [],
        'where' => [],
        'binds' => [],
        'orWhere' => [],
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
        // $this->queries['join'][] = " inner join {$table} on {$table}.id = {$this->queries['table']}.{$foreignKey}";
        array_push($this->queries['join'], " inner join {$table} on {$table}.id = {$this->queries['table']}.{$foreignKey}");
        return $this;
    }

    public function where(...$args)
    {
        $numArgs = count($args);

        if ($numArgs <= 1 || $numArgs > 3) {
            throw new Exception('O número de args tem quer no mínimo 2 e máximo 3');
        }

        $operator = '=';

        ($numArgs == 2) ?
        list($field, $value) = $args :
        list($field, $operator, $value) = $args;

        array_push($this->queries['binds'], $value);

        $this->queries['where'][] = "{$field} {$operator} ?";

        return $this;
    }

    public function orWhere(...$args)
    {
        $numArgs = count($args);

        if ($numArgs <= 1 || $numArgs > 3) {
            throw new Exception('O número de args tem quer no mínimo 2 e máximo 3');
        }

        $operator = '=';

        ($numArgs == 2) ?
        list($field, $value) = $args :
        list($field, $operator, $value) = $args;

        $this->queries['binds'][] = $value;

        $this->queries['orWhere'][] = "{$field} {$operator} ?";

        return $this;
    }

    public function like($field, $value)
    {
        $this->queries['like'][] = "{$field} like ?";
        $this->queries['binds'][] = "%{$value}%";
        return $this;
    }

    public function execute(IBuilder $builder)
    {
        $execute = new Execute;
        $execute->setQuery($this->queries);
        $execute->execute($builder);
    }
}
